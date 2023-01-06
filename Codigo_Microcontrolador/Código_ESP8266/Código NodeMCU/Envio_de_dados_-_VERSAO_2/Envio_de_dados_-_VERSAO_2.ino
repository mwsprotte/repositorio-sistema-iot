#include <ESP8266WiFi.h>

/*Inserindo dados da rede*/
/*SUBSTITUA OS TERMOS EM CAIXA ALTA A SEGUIR PELOS SEUS VALORES REAIS*/
const char * ssid = "NOME DA SUA INTERNET";
const char * password = "SENHA DA SUA INTERNET";
const char * host = "ENDEREÇO IPV4 DO SEU DISPOSITVO";

char* local = "SEU LOCAL (CASA, ESCRITÓRIO, LABORATÓRIO ETC.)";
float tensao = 143;
float corrente = 3;
float frequencia = 44;

void setup (){
  Serial.begin(9600);
  delay(10);

  /*Tenta realizar a conexão*/
  Serial.println();
  Serial.println();
  Serial.print("Conectando com ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status()!= WL_CONNECTED){
    delay (500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi Conectado!");
  Serial.print("Endereço de IP: ");
  Serial.println(WiFi.localIP());
  
}

void loop(){

  //======================================================
  //Aqui irá ficar a leitura dos sensores! -> Lógica
  //O CÓDIGO A SEGUIR É UM TESTE, SUBSITUA DE ACORDO COM AS LEITURAS RELEVANTES DA SUA PLACA

  tensao = tensao * 1.14;
  corrente = corrente * 1.2;
  frequencia = frequencia * 1.17;
  
  //======================================================

  /*Vai se conectar com o HOST*/
  Serial.print("Conectando-se com ");
  Serial.println(host);

  WiFiClient client;

  /*Tenta a conexão*/
  const int httpPort = 80;
  if(!client.connect(host, httpPort)){
    Serial.println("Falha na conexão!");
    return;
  }
  
  /*Caso a conexão aconteça, ele monta a URL*/ 
  /*SUBSTITUA XXX PELO IPV4 DE SEU DISPOSITIVO*/
  String url = "http://XXX/sistema-iot/acoes/salvar.php?";
         url += "local=";
         url += local;
         url += "&tensao=";
         url += tensao;
         url += "&corrente=";
         url += corrente;
         url += "&frequencia=";
         url += frequencia;

  /*Mostra a URL formada*/
  Serial.print("Requisitando URL: ");
  Serial.println(url);

  /*Envia a requisição para o servidor*/
  client.print(String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n");

  /*Verifica o tempo dessa requisição -> Evita travamento*/
  unsigned long timeout = millis();
  while (client.available() == 0){
    if (millis() - timeout > 5000){
      Serial.println(">>> CONEXÃO PERDIDA! - Tempo limite de espera esgotado! <<<");
      client.stop();
      return;
    }
  }

  /*Retorna, linha por linha, a resposta do servidor*/
  while(client.available()){
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  Serial.println();
  Serial.println("Conexão Encerrada");
  Serial.println();
  Serial.println();
  
  /*Tempo entre solicitações*/
  delay(5000);
}
