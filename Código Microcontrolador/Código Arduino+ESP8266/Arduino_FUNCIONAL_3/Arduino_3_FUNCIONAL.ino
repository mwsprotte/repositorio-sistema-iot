//DESENVILVIDO POR "ThatsEngineering" E APRIMORADO PELOS DISCENTES MATHEUS SPROTTE E YURI SCHEUER
//ENVIO DE DADOS DO ARDUINO PARA O ESP8266 VIA COMUNICAÇÃO SERIAL
//CÓDIGO ARDUINO

//BIBLIOTECAS PARA COMUNICAÇÃO COM O ESP
#include <SoftwareSerial.h>
#include <ArduinoJson.h>

SoftwareSerial ESP(5, 6);

//DECLARANDO AS VARIÁVEIS PARA ALOCAR OS DADOS:
float v_rms = 333;
float i_rms = 12;
float frequencia = 60;
float pot_s = 5;
float pot_p = 4;
float pot_q = 3 ;
//--------------------------------------------

void setup() {
  Serial.begin(9600);
  ESP.begin(9600);
  delay(1000);
}

void loop() {

  StaticJsonBuffer<1000> jsonBuffer;
  JsonObject& data = jsonBuffer.createObject();

  //  ESPAÇO DESTINADO A OBTENÇÃO E TRATAMENTO DOS DADOS DOS SENSORES

  v_rms = v_rms * 1.0005;
  i_rms = i_rms + 0.021;
  pot_s = i_rms * v_rms;

  //-----------------------------------------------------------------

  //ATRIBUINDO OS DADOS COLETADOS AO OBJETO JSON (JavaScript Object Notation)
  data["v_rms"] = v_rms;
  data["i_rms"] = i_rms;
  data["frequencia"] = frequencia;
  data["pot_s"] = pot_s;
  data["pot_p"] = pot_p;
  data["pot_q"] = pot_q;
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
  Serial.println("");

  //ENVIANDO ESSES DADOS PARA O ESP8266
  data.printTo(ESP);
  jsonBuffer.clear();

  delay(2000);
}
