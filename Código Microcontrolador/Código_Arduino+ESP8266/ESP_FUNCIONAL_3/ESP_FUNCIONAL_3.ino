//DESENVILVIDO POR "ThatsEngineering" E APRIMORADO PELOS DISCENTES MATHEUS SPROTTE E YURI SCHEUER
//ENVIO DE DADOS DO ARDUINO PARA O ESP8266 VIA COMUNICAÇÃO SERIAL
//CÓDIGO ESP8266

//BIBLIOTECAS PARA COMUNICAÇÃO COM O ARDUINO
#include <SoftwareSerial.h>
#include <ArduinoJson.h>

//BIBLIOTECA ESP PARA COMUNICAÇÃO WI-FI
#include <ESP8266WiFi.h>

//INSERINDO OS DADOS DA REDE E DO LUGAR, SUBSTITUA OS TERMOS EM CAIXA ALTA A SEGUIR PELOS VALORES REAIS
const char * ssid = "Sistema_IoT";
const char * password = "entrarentrar";
const char * host = "10.0.0.101";
char * local = "A301";
//-----------------------------------------------------------------------------------------------------

void setup() {
  Serial.begin(9600);
  while (!Serial) continue;

  //TENTA CONECTAR COM A REDE WI-FI
  Serial.println();
  Serial.println();
  Serial.print("Conectando com ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay (500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi Conectado!");
  Serial.print("Endereço de IP deste ESP: ");
  Serial.println(WiFi.localIP());
}

void loop() {

  StaticJsonBuffer<1000> jsonBuffer;
  JsonObject& data = jsonBuffer.parseObject(Serial);

  if (data == JsonObject::invalid()) {
    Serial.println("Não foi possível receber dados (objeto JSON inválido).");
    jsonBuffer.clear();
    return;
  }

  //RECDEBE OS DADOS VINDOS DO ARDUINO
  float v_rms = data["v_rms"];
  float i_rms = data["i_rms"];
  float frequencia = data["frequencia"];
  float pot_s = data["pot_s"];
  float pot_p = data["pot_p"];
  float pot_q = data["pot_q"];
  float fp = data["fp"];
  float diferencaFase = data["diferencaFase"]; //dada em graus

  //SE CONECTA COM O HOST
  Serial.print("Conectando-se com ");
  Serial.println(host);

  WiFiClient client;

  //TESTA A CONEXÃO
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Falha na conexão!");
    return;
  }

  //CASO A CONEXÃO ACONTEÇA, ELE MONTA A URL
  String url = "http://";
  url += host;
  url += "/sistema-iot/acoes/salvar3.php?";
  url += "local=";
  url += local;
  url += "&v_rms=";
  url += v_rms;
  url += "&i_rms=";
  url += i_rms;
  url += "&frequencia=";
  url += frequencia;
  url += "&pot_s=";
  url += pot_s;
  url += "&pot_p=";
  url += pot_p;
  url += "&pot_q=";
  url += pot_q;
  url += "&fp=";
  url += fp;
  url += "&diferencaFase=";
  url += diferencaFase;

  //MOSTRA A URL FORMADA
  Serial.print("Requisitando URL: ");
  Serial.println(url);

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
    Serial.print(line);
  }

  Serial.println();
  Serial.println("Conexão Encerrada");
  Serial.println();
  Serial.println();

  delay(5000);
}
