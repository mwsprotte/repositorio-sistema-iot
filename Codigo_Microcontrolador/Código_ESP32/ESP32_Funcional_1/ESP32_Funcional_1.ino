/*
 *  This sketch sends data via HTTP GET requests to data.sparkfun.com service.
 *
 *  You need to get streamId and privateKey at data.sparkfun.com and paste them
 *  below. Or just customize this script to talk to other HTTP servers.
 *
 */

#include <WiFi.h>

const char* ssid     = "Redmi Note 9S";
const char* password = "aurora0506";
char * local = "Apto";

const char* host = "192.168.57.90";


//const char* streamId   = "....................";
//const char* privateKey = "....................";

void setup()
{
    Serial.begin(115200);
    delay(10);

    // We start by connecting to a WiFi network

    Serial.println();
    Serial.println();
    Serial.print("Connecting to ");
    Serial.println(ssid);

    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
}

int value = 0;



//DECLARANDO AS VARIÁVEIS
float coeficiente = 5; //Envio para o servidor (coeficiente medido)
float def_sensor = 56; //variável auxiliar de deformção usada para cálculos
float coeficiente_calculo = 1; // coef.calculado no strain gauge
float deformacao; //deformação medida enviada para o servidor
float deformacao_total1 = (4.7 / 1000);
float deformacao_total = 0;




void loop()
{

    
   
     deformacao = (coeficiente_calculo * deformacao_total1) * 1000000000;
    coeficiente = coeficiente_calculo * 1000000;
    
    delay(5000);
    ++value;

    Serial.print("connecting to ");
    Serial.println(host);

    // Use WiFiClient class to create TCP connections
    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
        Serial.println("connection failed");
        return;
    }


     
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


    Serial.print("Requesting URL: ");
    Serial.println(url);

    // This will send the request to the server
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 5000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }

    // Read all the lines of the reply from server and print them to Serial
    while(client.available()) {
        String line = client.readStringUntil('\r');
        Serial.print(line);
    }

    Serial.println();
    Serial.println("closing connection");
}
