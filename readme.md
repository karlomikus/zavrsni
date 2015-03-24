# JOBBR

Završni rad za fakultet.
Aplikacija za upravljanje poslova. [Više je opisano u samom radu.](https://dl.dropboxusercontent.com/u/54195022/KarloMiku%C5%A1-Zavr%C5%A1niRad.pdf)

Tehnologije:
- Laravel 4
- MySQL
- Angular
- Vagrant
- REST

# Instalacija

> Prvih 5 koraka nisu potrebna ako već imate pripremljeno okruženje za LAMP razvoj.
> Ovdje su upute za pripremanje okruženja opisanog u završnom radu.

1. Instalirati [Vagrant](https://www.vagrantup.com/) i VirtualBox
2. Generirati [PuPHPet](https://puphpet.com/) konfiguraciju sa priloženom konfiguracijskom datotekom
3. Pokrenuti instalaciju mašine sa `vagrant up` naredbom
4. Nakon instalacije spojiti se na nju putem `vagrant ssh`
5. Ući u root folder projekta, uobičajeno `/var/www/`
6. Pokrenuti migracije naredbom `php artisan migrate`
7. Pokrenuti kreiranje demo podataka naredbom `php artisan db:seed`
8. Aplikacija bi trebala biti spremna, admin informacije za prijavu:

> Email: admin@admin.com
> Password: admin123