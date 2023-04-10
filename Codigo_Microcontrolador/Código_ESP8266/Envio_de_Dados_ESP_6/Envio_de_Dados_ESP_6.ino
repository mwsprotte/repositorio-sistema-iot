//DESENVILVIDO POR "ThatsEngineering" E APRIMORADO PELOS DISCENTES MATHEUS SPROTTE, YURI SCHEUER E LUIS VIEIRA
//ENVIO DE DADOS DO ESP8266 PARA UM SERVIDOR LOCAL

//BIBLIOTECA ESP PARA COMUNICAÇÃO WI-FI
#include <ESP8266WiFi.h>

//INSERINDO OS DADOS DA REDE E DO LUGAR, SUBSTITUA OS TERMOS EM CAIXA ALTA A SEGUIR PELOS VALORES REAIS
const char * ssid = "Rede-IoT-Matheus";
const char * password = "entrarentrar";
const char * host = "192.168.0.101";
char * local = "Teste";
//-----------------------------------------------------------------------------------------------------

//DECLARANDO AS VARIÁVEIS
float coeficiente; //Envio para o servidor (coeficiente medido)
float def_sensor; //variável auxiliar de deformção usada para cálculos
float coeficiente_calculo; // coef.calculado no strain gauge
float deformacao; //deformação medida enviada para o servidor
float deformacao_total1 = (4.7 / 1000);
float deformacao_total = 0;

const int ADCPin = 36;

//VARIÁVEL PARA ARMAZENAMENTO DO VALOR ADC E TENSÃO
int adcValor = 0;
float volt = 0;

// some constants - algumas constantes
const unsigned int analogInPin = A0;    // Analog input - pino analógico
const float analogLimit = 1.0;          // Limit of Analog In. - Limite da entrada analogica

// used variables - variáveis utilizadas
unsigned int RAWanalogInput = 0;        // save the RAW value of A0 - armazena o valor RAW de A0
float analogInputVoltage = 0;           // save the converted A0 voltage - armazena a tensão convertida de A0
float Vusb = 0;

void setup() {
  Serial.begin(115200);
  while (!Serial) continue;

  //TENTA CONECTAR COM A REDE WI-FI
  Serial.println();
  Serial.println();
//  Serial.print("Conectando com ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay (500);
    Serial.print(".");
  }
//  Serial.println("");
//  Serial.println("WiFi Conectado!");
//  Serial.print("Endereço de IP deste ESP: ");
  Serial.println(WiFi.localIP());
}

void loop() {

  //CÁLCULO DOS DADOS
  // read the analog input - le a entrada analogica
  RAWanalogInput = analogRead(analogInPin);

  // print RAW value - imprime o valor RAW
  //  Serial.print("RAW value: "); Serial.println(RAWanalogInput, 16);

  // convert RAW value in voltage - converte o valor RAW em tensao
  analogInputVoltage = (float)RAWanalogInput * (analogLimit / 1024);

  // print A0 voltage - imprime a tensao em A0
  Serial.print("ADC voltage: "); Serial.println(analogInputVoltage, 16);
  //   Serial.println("");

    delay(500);

  adcValor = analogRead(analogInPin);

  volt = analogInputVoltage / 945.1629691;
  float offset = 0;
  volt = volt - (offset / 1000000);
  coeficiente_calculo = volt / (2.2 * 3.31500*2);

//Para a barra:
//coeficiente_calculo = volt / (2.2 * 3.31500);

  //  coeficiente_calculo = def_sensor / (4E-3);
  deformacao = (coeficiente_calculo * deformacao_total1) * 1000000000;
  //  deformacao_total = deformacao_total + deformacao;

  coeficiente = coeficiente_calculo * 1000000;

  //  //IMPRIMI OS VALORES NO MONITOR SERIAL
  //  Serial.print(" Valor ADC: ");
  //  Serial.println(adcValor, 16);
  //  Serial.print(" Tensao: ");
  //  Serial.print(analogInputVoltage, 16);
  //  Serial.println("V");
  //  Serial.println("");


  //  Serial.println("");
  //  Serial.println(deformacao);
  //  Serial.println(coeficiente);
  //  Serial.println("");

  //SE CONECTA COM O HOST
  //  Serial.print("Conectando-se com ");
  //  Serial.println(host);

  WiFiClient client;

  //TESTA A CONEXÃO
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Falha na conexão!");
    return;
  }

  //  //CASO A CONEXÃO ACONTEÇA, ELE MONTA A URL
  String url = "http://";
  url += host;
  url += "/sistema-iot/acoes/salvar2.php?";
  url += "local=";
  url += local;
  url += "&coeficiente=";
  url += coeficiente;
  url += "&deformacao=";
  url += deformacao;
  url += "&deformacao_total=";
  url += deformacao_total;


  //MOSTRA A URL FORMADA
  //  Serial.print("Requisitando URL: ");
  //  Serial.println(url);

  //ENVIA A REQUISIÇÃO PARA O SERVIDOR
  client.print(String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");

  //VERIFICA O TEMPO DA REQUISIÇÃO, E ENCERRA CASO DEMORE MUITO (EVITA TRAVAMENTO)
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> CONEXÃO PERDIDA! - Tempo limite de espera esgotado! <<<");
      client.stop();
      return;
    }
  }

  //RETORNA A RESPOSTA DO SERVIDOR
  while (client.available()) {
    String line = client.readStringUntil('\r');
//    Serial.print(line);
  }

  //  Serial.println();
  //  Serial.println("Conexão Encerrada");
  //  Serial.println();
  //  Serial.println();

}
