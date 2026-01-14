# Celowo – System zarządzania pracownikami i ewidencji godzin pracy

## Opis projektu
Aplikacja webowa stworzona w frameworku **Laravel**, służąca do zarządzania użytkownikami firmy oraz ewidencji godzin pracy pracowników.  
System posiada role użytkowników, panel administratora oraz funkcjonalność tematyczną zgodną z wymaganiami projektu.

---

## Technologie
- PHP 8.x
- Laravel
- MySQL / MariaDB
- Blade + Tailwind CSS
- Laravel Breeze (autoryzacja)

---

## Role użytkowników
- **Employee** – pracownik  
- **Manager** – przełożony  
- **Admin** – administrator systemu  

Dostęp do funkcji jest kontrolowany za pomocą middleware.

---

## Funkcjonalności

### Autoryzacja
- Rejestracja użytkowników
- Logowanie
- Hasła przechowywane w postaci zaszyfrowanej (bcrypt)

---

### Panel administratora
- Lista użytkowników
- Dodawanie użytkowników
- Edycja użytkowników
- Usuwanie użytkowników
- Przypisywanie ról
- Podgląd godzin pracy wszystkich pracowników

---

### Ewidencja godzin pracy (funkcjonalność tematyczna)
- Manager/Admin dodaje godziny pracy pracownikom
- Employee widzi swoje godziny pracy w ujęciu miesięcznym
- Możliwość filtrowania wpisów po miesiącu
- Możliwość komentowania dni pracy (employee / manager / admin)
- Historia wpisów przechowywana w bazie danych

---

## Bezpieczeństwo
- Middleware `auth`
- Middleware ról użytkowników
- Walidacja danych wejściowych
- Eloquent ORM (ochrona przed SQL Injection)

---

## Instrukcja uruchomienia projektu

1. Sklonować / pobrać projekt
2. Utworzyć bazę danych (np. `celowo`)
3. Skonfigurować plik `.env`
4. Uruchomić migracje:
   ```bash
   php artisan migrate
