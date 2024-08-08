=== WooCommerce Payment Gateway - tpay.com  ===
Contributors: tpay.com
Donate link: https://tpay.com/
Tags: woocommerce, tpay, payment, polish gateway, polska brama płatności, bramka płatności, płatności internetowe
Requires at least: 4.7.0
Tested up to: 5.7
Requires PHP: 5.3
Stable tag: 2.9.9
License: GPLv2

Accept payments from all major polish banks directly on your WooCommerce site via tpay.com polish payment gateway system.

== Description ==

# Brama płatnicza Tpay dla WooCommerce
Jednym z podstawowych czynników, który decyduje o wyborze e-sklepu, są dostępne sposoby płatności. Korzystając z bramki płatniczej Tpay dla WooCommerce dajesz klientom możliwość skorzystania z **najpopularniejszych** metod płatności (i to Ty od ręki decydujesz, które z nich będą widoczne).
- BLIK,
- przelew online,
- przelew tradycyjny,
- karta kredytowa,
- karta debetowa,
- portfele elektroniczne, m.in. Visa Checkout, Masterpass, PayPal.
**Panel transakcyjny Tpay** zawiera metody płatności pogrupowane zgodnie z intuicją użytkowników i doskonale wyświetla się także na mobile, dzięki czemu internauci mogą finalizować zamówienia na każdym wybranym urządzeniu.

**Dodatkowe funkcjonalności** systemu obejmują **przelewy masowe** oraz **biblioteki mobilne**, umożliwiające integrację modułu szybkich płatności w dowolnej aplikacji mobilnej (opracowane są zarówno na systemy Android, jak i na iOS).

**Ofertę Tpay stanowią również rozwiązania m.in. skracające ścieżkę zakupową i pomagające walczyć z porzuconymi koszykami:**
- **Widget One Click**, który dzięki wdrożenym płatnościom BLIK, umożliwia sprzedaż bezpośrednio z poziomu baneru (bez konieczności przejścia na dodatkową podstronę, za checkoutem) lub z poziomu sklepu, znacznie skracając ścieżkę zakupową,
- **panel on-site**, czyli wdrożenie metod płatności bezpośrednio na stronie sklepu, co umożliwia zapamiętanie danych karty - klienci płacą jednym kliknięciem,
- **płatności rekurencyjne** gwarantujące  cykliczne obciążanie rachunku klienta poprzez kartę płatniczą, na podstawie pierwszej zatwierdzonej przez niego  transakcji,
- raty online,
- SMS Premium,
- płatności za pomocą kodu QR.

W czasie pandemii co trzeci Polak zwiększył liczbę płatności online, ale jednocześnie prawie połowa badanych obawia się zmniejszenia bezpieczeństwa takich transakcji (BIK, 2020). Tpay posiada rozszerzoną licencją Komisji Nadzoru Finansowego, co oznacza spełnianie rygorystycznych wymogów **bezpieczeństwa**. Operator zapewnia poziom bezpieczeństwa potwierdzony certyfikatem PCI DSS Level 1 i jednocześnie gwarantuje pełną wygodę oraz możliwość natychmiastowej finalizacji zamówienia.

Technologia i jej najwyższa jakość są niezbędne, ale za każdym biznesem stoi **człowiek**. Tpay ma tego pełną świadomość, dlatego dba o dobre relacje ze swoimi klientami. Zapewnia wsparcie indywidualnego opiekuna, a średni czas oczekiwania w jego biurze obsługi klienta wynosi 1 dzień.

 Instalacja
 INSTALLATION INSTRUCTION
 https://support.tpay.com/pl/developer/addons/woocommerce/woocommerce-instrukcja
 TESTY
 Moduł był testowany na systemie zbudowanym z wersji Woocommerce 4.4.1 i WordPress 5.3
 KONTAKT
 W razie wątpliwości lub potrzeby wyjaśnienia kwestii technicznych skontaktuj się z Tpay poprzez formularz znajdujący się w Panelu Odbiorcy Płatności lub wyślij wiadomość na adres e-mail: pt@tpay.com

== Changelog ==
v2.9.9
Poprawiono przekierowanie po nieudanej płatności BLIK level 0
v2.9.8
Poprawiono działanie zwrotów kartowych
v2.9.7
Poprawiono obsługę polskich znaków w opisie transakcji.
v2.9.6
Poprawiono obsługę znaków specjalnych.
v2.9.5
Poprawiono obsługę mechanizmu sumy kontrolnej w przypadku zapisu karty.
v2.9.4
Dodano obsługę nowego mechanizmu sum kontrolnych
v2.9.3
Dodano informację o konieczności zatwierdzenia płatności BLIK na stronie podziękowania za zamówienie.
v2.9.2
Dodano linki do angielskich dokumentów pdf
Dodano automatyczną aktualizację zamówień o statusie "failed" na poprawne, na podstawie powiadomienia o transakcji.
v2.9.1
Usunięto ingerencję w jQuery wykorzystywane przez Wordpress.
Zabezpieczono działanie skryptów JS przed niezdefiniowanym jQuery.
Zoptymalizowano kod pod względem szybkości działania.
v2.9.0
Zmniejszono wersję wymaganą jQuery do 2.0.3
v2.8.9
Usprawniono ładowanie templatek, skryptów JS i styli CSS - rozbito templatki i skrypty do osobnych plików. Zastosowano ładowanie zależności JS.
Podniesiono wykorzystywaną wersję jQuery do 3.1.1
Naprawiono błąd ładowania templatek na frontent, powodujący escape'owanie skryptów jako treść strony.
Zabezpieczono wtyczkę przed wielokrotną aktualizacją statusu zamówienia w przypadku problemów z odbieraniem powiadomień.
Dodano opcję wyboru statusu zamówienia po jego złożeniu (przed opłaceniem).
v2.8.8
Naprawiono przekazywanie nazwy posiadacza karty do bramki płatności kartą.
Poprawiono rozpoznawanie czy wtyczka Woocommerce jest zainstalowana.
v2.8.7
Poprawiono błąd w ustawieniu weryfikacji powiadomień wymuszający weryfikację adresów IP
Dodano klauzulę informacyjną RODO
Zablokowano możliwość ponownej edycji statusu przez powtórne wysyłanie powiadomień o wpłatach
v2.8.6
Naprawiono problem z wyświetlaniem opisu metody płatności
Naprawiono odbieranie powiadomień dla transakcji przez bramkę kartową
v2.8.5
Naprawiono błąd oznaczania statusu niektórych płatności kartą.
v2.8.4
Naprawiono problem ładowania plików statycznych
v2.8.3
Zoptymalizowano kod wyzwalający wtyczkę.
Rozdzielono wykorzystanie wtyczki podstawowej i kartowej
Dodano niezależną opcję sprawdzania proxy dla wtyczki kartowej
Dodano informacje o kompatybilności z WooCommerce
Usunięto problem z nadpisywaniem styli checkbox'u akceptacji regulaminu Tpay
v2.8.2
Poprawiono błąd w składni SQL powodujący brak możliwości aktualizacji niektórych instancji modułu.
v2.8.1
Dodano wiele poprawek wyświetlania formularzy
v2.8.0
Rebranding - wprowadzono nowe style formularzy oraz zmieniono logotypy Tpay.
v2.7.9
Poprawiono wyświetlanie formularza banków w widoku listy rozwijanej.
Poprawiono walidację kodu BLIK i treść formularza BLIK.
v2.7.8
Poprawiono rozpoznawanie języka w transakcjach kartą
v2.7.7
Dostosowano opcjonalność niektórych parametrów adresowych przy tworzeniu transakcji BLIK
v2.7.6
Dodano możliwość zapisania karty przez wszystkich użytkowników.
Poprawiono funkcjonalność formularza kartowego.
v2.7.5
Poprawiono sposób walidacji formularza płatności kartą.
v2.7.4
Dodano przechowywanie informacji o języku płatnika w module Tpay credit cards, w celu poprawnego informowania o zwrotach.
v2.7.3
Poprawiono wyświetlanie bramki kartowej i obsługę skryptów
v2.7.2
Dodano obsługę subskrypcji z dodatkiem Woocommerce Subscriptions
Dodano opcję wyświetlania kanałów księgujących wyłącznie online lub wszystkich
v2.7.01
Naprawiono błąd wywoływania klasy WC_Shipping
v2.7.0
Dodano możliwość zapisywania kart płatniczych do ponownego użytku w module tpay.com credit cards dla zalogowanych użytkowników.
Dodano mechanizm ponawiania płatności po nieudanej płatności nową lub zapisaną kartą.
Dodano obsługę usuwania wyrejestrowanych kart.
Dodano obszerniejsze logowanie czynności klienta w szczegółach zamówienia.
Dodano obsługę zwrotów wykonywanych w Panelu Odbiorcy Płatności.
v2.6.55
Poprawka logowania powiadomień o wpłatach
v2.6.54
Poprawka kalkulacji wartości koszyka dla starszych wersji woocommerce
v2.6.53
Aktualizacja płatności ratami
v2.6.52
Poprawiono błąd działania wtyczki spowodowany przestarzałymi danymi konfiguracyjnymi metod wysyłki.
v2.6.51
Usunięto zdublowane wyświetlanie informacji o prowizji za płatność
v2.6.50
Wyświetlanie bramki płatności kartami w języku polskim i angielskim
v2.6.47
Poprawiono kompatybilność z edytorem menu
v2.6.46
Naprawiono konflikt z przestarzałą metodą wysyłki local_pickup
v2.6.45
Poprawki kodu źródłowego
v2.6.44
Dodano zabezpieczenie przed błędami pobierania listy dostępnych metod wysyłki
v2.6.43
Dodano logowanie błędów BLIK
Dodano automatycznie przekierowanie do panelu transakcyjnego w przypadku błędnego kodu blik
Dodano zabezpieczenie przed błędami pobierania listy dostępnych metod wysyłki
v2.6.42
Zabezpieczenie przed wyjątkami w pobieraniu metod wysyłki
v2.6.41
Zabezpieczenie przed wyjątkami w pobieraniu metod wysyłki
Rozpoznawanie języka w opisie transakcji
v2.6.4
Aktualizacja kompatybilności ze starszymi wersjami Woocommerce
v2.6.3
Dodano parowanie metody płatności z metodą wysyłki.
Zaktualizowano bibliotekę szyfrującą dane karty.
v2.6.2
Poprawiony błędny link w formularzu płatności kartą.
v.2.6.1
Poprawiono błąd zwracany przy odrzuconej płatności kartowej bez 3DS.
v2.6.0
Poprawiono przekierowania na uszkodzone adresy URL stron sukcesu i niepowodzenia.
v2.5.9
Zmodyfikowano wyświetlanie kanału Raty
Usunięto nadpisanie CSS zaznaczenia tekstu
v2.5.8
Zmodyfikowano zarządzanie stanem magazynowym. Zmieniono stronę błędu na adres ponawiania zapłaty.
v2.5.7
Wyłączono wyświetlanie regulaminu w trybie przekierowania do panelu transakcyjnego.
v2.5.6
Rozwiązano problem z autokorektą wprowadzanego numeru karty kredytowej
v2.5.5
Dodano możliwość wyłączenia walidacji IP serwera powiadomień
v2.5.4
Rozwiązano konflikt z PHP 7.1
v2.5.3
Dodano zbieranie statystyk modułu
v2.5.2
Poprawiono nadpisywanie wyglądu pól formularza płatności.
v2.5.1
Dodano opcję automatycznego oznaczania zamówienia jako zrealizowane
v2.5.0
Dodano obsługę zwrotów z panelu widoku zamówienia. Aby opcja zwrotów była aktywna i działała poprawnie, należy wygenerować i wprowadzić klucz API w ustawienia wtyczki zgodnie z instrukcją https://secure.tpay.com/integration/instruction/64

== Frequently Asked Questions ==
Feel free to contact us on info@tpay.com
== Upgrade Notice ==
= 2.5.0 =
Dodano obsługę zwrotów z panelu widoku zamówienia. Aby opcja zwrotów była aktywna i działała poprawnie, należy wygenerować i wprowadzić klucz API w ustawienia wtyczki zgodnie z instrukcją https://secure.tpay.com/integration/instruction/64
== Screenshots ==
no screenshots
