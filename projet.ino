#include <LiquidCrystal.h>
#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>


#define BUZZER_PIN 27 // Remplacez par le numéro de broche GPIO que vous utilisez pour le buzzer
#define LED_PIN_GREEN 14 // Numéro de la broche GPIO utilisée pour la LED verte
#define LED_PIN_RED 13 // Numéro de la broche GPIO utilisée pour la LED rouge
#define SS_PIN 4  // Broche SS du module RFID
#define RST_PIN 5 // Broche RST du module RFID


const char* ssid = "S20fe";      // Remplacez par le nom de votre réseau Wi-Fi
const char* password = "antho4225";  // Remplacez par le mot de passe de votre réseau Wi-Fi

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Créer une instance de la classe MFRC522
LiquidCrystal lcd(21, 22, 2, 17, 16, 15); // Initialiser la bibliothèque avec les numéros des broches d'interface

struct Card {
  String ID;
  String firstName;
};

Card cards[] = {
  {"b71d653f", "DAMIEN IPRANOSSIAN"},
  {"04313872437080", "ANTHONY JACON"},
  {"831fc214", "SACHA KNOPLOCH"},
  {"4979d5b3", "AURELIEN MARIETTON"}, 
  // Ajoutez d'autres cartes avec leurs ID et prénoms associés ici
};

int numCards = sizeof(cards) / sizeof(cards[0]);

void setup() {
  Serial.begin(9600);

  // Connexion au réseau Wi-Fi
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connexion en cours au réseau Wi-Fi...");
  }

  Serial.println("Connecté au réseau Wi-Fi !");
  Serial.print("Adresse IP : ");
  Serial.println(WiFi.localIP());

  lcd.begin(16, 2);    // Initialiser le nombre de colonnes et de lignes de l'écran LCD
  lcd.clear(); // Effacer l'écran LCD
  lcd.setCursor(0, 0); // Déplacer le curseur à la première ligne, première colonne
  lcd.print("Adresse IP:"); // Afficher "Adresse IP:" sur l'écran LCD
  lcd.setCursor(0, 1); // Déplacer le curseur à la deuxième ligne, première colonne
  lcd.print(WiFi.localIP()); // Afficher l'adresse IP sur l'écran LCD

  SPI.begin();         // Initialiser la communication SPI
  mfrc522.PCD_Init();  // Initialiser le module RFID

  lcd.setCursor(0, 0); // Déplacer le curseur à la première ligne, première colonne
  lcd.print("BONJOUR"); // Afficher "BONJOUR" sur l'écran LCD

  ledcSetup(0, 2000, 8); // Configure le canal LEDC 0 pour le buzzer
  ledcAttachPin(BUZZER_PIN, 0); // Attache la broche du buzzer au canal LEDC 0
  pinMode(LED_PIN_GREEN, OUTPUT); // Configure la broche de la LED verte en sortie
  pinMode(LED_PIN_RED, OUTPUT); // Configure la broche de la LED rouge en sortie
}

void loop() {
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    // Si une nouvelle carte est détectée, lire son identifiant
    String cardID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardID += String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "");
      cardID += String(mfrc522.uid.uidByte[i], HEX);
    }
    Serial.println("ID de la carte : " + cardID);

    lcd.clear(); // Effacer l'écran LCD
    lcd.setCursor(0, 0); // Déplacer le curseur à la première ligne, première colonne
    lcd.print("    BONJOUR"); // Afficher "BONJOUR" sur l'écran LCD

    String firstName = getFirstName(cardID); // Obtenir le prénom associé à l'ID de la carte

    if (firstName != "") {
      lcd.setCursor(0, 1); // Déplacer le curseur à la deuxième ligne, première colonne
      lcd.print(firstName); // Afficher le prénom sur l'écran LCD
      playConfirmationSound(); // Jouer le son de confirmation
      digitalWrite(LED_PIN_GREEN, HIGH); // Allumer la LED verte
      digitalWrite(LED_PIN_RED, LOW); // Éteindre la LED rouge
    } else {
      lcd.clear(); // Effacer l'écran LCD
      lcd.setCursor(0, 0); // Déplacer le curseur à la première ligne, première colonne
      lcd.print("ERREUR CARTE"); // Afficher "ERREUR CARTE" sur l'écran LCD
      playErrorSound(); // Jouer le son d'erreur
      digitalWrite(LED_PIN_GREEN, LOW); // Éteindre la LED verte
      digitalWrite(LED_PIN_RED, HIGH); // Allumer la LED rouge
    }

    mfrc522.PICC_HaltA();  // Mettre la carte en veille
    mfrc522.PCD_StopCrypto1();  // Arrêter la communication avec la carte
    delay(1000); // Pause de 1 seconde entre les lectures de carte
    digitalWrite(LED_PIN_GREEN, LOW); // Éteindre la LED verte
    digitalWrite(LED_PIN_RED, LOW); // Éteindre la LED rouge
  }
}

void playTone(int frequency, int duration) {
  ledcWriteTone(0, frequency);
  delay(duration);
  ledcWriteTone(0, 0);
}

void playConfirmationSound() {
  playTone(1000, 100);
  delay(200);
  playTone(1500, 100);
  delay(200);
  playTone(2000, 100);
}

void playErrorSound() {
  playTone(2000, 200);
  delay(200);
  playTone(1500, 200);
  delay(200);
  playTone(1000, 200);
}

String getFirstName(String cardID) {
  for (int i = 0; i < numCards; i++) {
    if (cards[i].ID == cardID) {
      return cards[i].firstName;
    }
  }
  return ""; // Retourne une chaîne vide si l'ID de la carte n'est pas trouvé
}
