# BoolBnB

BoolBnB è una piattaforma web per la ricerca e gestione di appartamenti in affitto. Sviluppata in Laravel, offre funzionalità sia per i proprietari di appartamenti che per i visitatori in cerca di un soggiorno ideale.

## Funzionalità Principali

- **Ricerca Avanzata**: Filtraggio di appartamenti per posizione, numero di stanze, servizi e distanza.

- **Dettagli Appartamento**: Visualizzazione completa delle informazioni con mappa interattiva.

- **Messaggistica**: Comunicazione diretta tra visitatori e proprietari.

- **Dashboard Proprietari**: Pannello di gestione per aggiungere, modificare e sponsorizzare appartamenti.

- **Sponsorizzazione**: Possibilità di mettere in evidenza gli appartamenti attraverso pacchetti a pagamento.

- **Statistiche e Grafici**: Visualizzazione delle statistiche di accesso e interazione degli appartamenti tramite grafici, utilizzando la libreria Chart.js, che mostra il numero di visualizzazioni e messaggi ricevuti nel tempo.

## Architettura delle Pagine

- **Homepage**: Ricerca rapida e visualizzazione di appartamenti in evidenza.

- **Ricerca Avanzata**: Filtri per numero di stanze, distanza e servizi.

- **Dettaglio Appartamento**: Vista dettagliata con opzioni per contattare il proprietario.

- **Dashboard Proprietario**: Gestione degli appartamenti, messaggi e statistiche, inclusi grafici di performance.

## Geolocalizzazione

La piattaforma utilizza le API TomTom per salvare le posizioni degli appartamenti, consentendo di visualizzarli su una mappa e affinare la ricerca in base alla posizione geografica.

## Sistema di Pagamento

I pagamenti per la sponsorizzazione degli appartamenti sono gestiti tramite Braintree, che offre transazioni sicure con carta di credito. I pacchetti di sponsorizzazione variano in durata e costo.

## Clausola sull'uso della libreria Chart

La libreria Chart.js è utilizzata per la visualizzazione dei dati statistici all'interno della piattaforma. Gli utenti sono invitati a consultare la [documentazione di Chart.js](https://www.chartjs.org/docs/latest/) per comprendere le funzionalità e le limitazioni di questa libreria.

## Conclusione

BoolBnB offre un'esperienza semplificata sia per la ricerca di appartamenti in affitto che per la gestione degli immobili, grazie a un'interfaccia intuitiva e funzionalità avanzate.

## Autore

Progetto realizzato da **Arianna Salvini**.

## Licenza

Questo progetto è open-source e distribuito sotto licenza MIT.