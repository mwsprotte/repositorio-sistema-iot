//DESENVILVIDO POR "ThatsEngineering" E APRIMORADO PELOS DISCENTES MATHEUS SPROTTE E YURI SCHEUER
//ENVIO DE DADOS DO ARDUINO PARA O ESP8266 VIA COMUNICAÇÃO SERIAL
//CÓDIGO ARDUINO
//Função do código original: Enviar informações da serial do Arduino para o ESP8266, que por sua vez envia os dados a um servidor
//Última atualização em 15/03/22: Inserindo as funções de medição de energia

//BIBLIOTECAS PARA COMUNICAÇÃO COM O ESP
#include <SoftwareSerial.h>
#include <ArduinoJson.h>
#include <math.h>
#define PI 3.14159265

//--------------------------------------------
// DESIGNANDO UM PAR DE PINOS PARA O ENVIO DE DADOS VIA SERIAL
SoftwareSerial ESP(10, 11); //(RX, TX)

//DECLARANDO AS VARIÁVEIS PARA ALOCAR OS DADOS:
float v_inst = 0;
float i_inst = 0;
float v_rms = 0;
float i_rms = 0;
unsigned long periodo;
float frequencia = 0;
float pot_s = 0;
float pot_p = 0;
float pot_q = 0 ;
float fp = 0;
float nivelCC = 0;
float diferencaFase = 0;


//DECLARANDO FATORES DE CORREÇÃO
float fatorTensao = 0.6912089; // fatorTensao = tensão(pico a pico)/1023
float fatorCorrente = 0.00488758553*2.5972857; // fatorCorrente = 2.5972857*corrente(pico a pico)/1023  (2,59... é um fator de multiplicação para a bobina de 900 voltas)


//--------------------------------------------

//DECLARANDO OS PINOS DAS ENTRADAS DE DADOS
const int pinoSensorCorrente = A3;
const int pinoSensorTensao = A5;
const int pinoNivelCC = A4;
int pinFreq = 8;

//--------------------------------------------

//FUNÇÃO - MEDIÇÃO DE FREQUÊNCIA PELO pulseIn

float lerFreq() {
  periodo = pulseIn(pinFreq, HIGH) + pulseIn(pinFreq, LOW);
  frequencia = 1E6 / (periodo);
  return frequencia;
}

void setup() {
  Serial.begin(9600);
  ESP.begin(9600);
  delay(1000);

}


void loop() {

  StaticJsonBuffer<1000> jsonBuffer;
  JsonObject& data = jsonBuffer.createObject();

  //  ESPAÇO DESTINADO A OBTENÇÃO E TRATAMENTO DOS DADOS DOS SENSORES

  nivelCC = analogRead(pinoNivelCC);

  for (int a = 0; a <= 1000; a++) {
    i_inst = analogRead(pinoSensorCorrente);
    i_inst = (i_inst * fatorCorrente) - (nivelCC * fatorCorrente);
    v_inst = analogRead(pinoSensorTensao);
    v_inst = (v_inst * fatorTensao) - (nivelCC * fatorTensao);

    v_rms = v_rms + pow(v_inst, 2); // a função pow é para elevar um número a uma determinada potência
    i_rms = i_rms + pow(i_inst, 2);
    pot_p = pot_p + (v_inst * i_inst);
  }

  v_rms = sqrt(v_rms / 1000);
  i_rms = sqrt(i_rms / 1000);
  pot_s = i_rms * v_rms;
  pot_p = pot_p / 1000;
  pot_q = sqrt(pow(pot_s, 2) - pow(pot_p, 2));
  fp = pot_p / pot_s;
  frequencia = lerFreq();
  diferencaFase = (180 / PI) * acos(fp);

  //-----------------------------------------------------------------

  //ATRIBUINDO OS DADOS COLETADOS AO OBJETO JSON (JavaScript Object Notation)
  data["v_rms"] = v_rms;
  data["i_rms"] = i_rms;
  data["frequencia"] = frequencia;
  data["pot_s"] = pot_s;
  data["pot_p"] = pot_p;
  data["pot_q"] = pot_q;
  data["fp"] = fp;
  data["diferencaFase"] = diferencaFase;
  //  -----------------------------------------------------------------------

  //EXIBE OS DADOS A SEREM ENVIADOS
  Serial.println("Enviando dados para o ESP");
  Serial.print("Tensão RMS: ");
  Serial.println(v_rms);
  Serial.print("Corrente RMS: ");
  Serial.println(i_rms);
  Serial.print("Frequência: ");
  Serial.println(frequencia);
  Serial.print("Potência aparente: ");
  Serial.println(pot_s);
  Serial.print("Potência ativa: ");
  Serial.println(pot_p);
  Serial.print("Potência reativa: ");
  Serial.println(pot_q);
  Serial.println("Fator de potência: ");
  Serial.println(fp);
  Serial.println("Diferença de Fases: ");
  Serial.println(diferencaFase);
  Serial.println("");

  //ENVIANDO ESSES DADOS PARA O ESP8266
  data.printTo(ESP);
  jsonBuffer.clear();

  delay(10000);
}
