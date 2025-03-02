За да може да работи проекта е необходимо да имате инсталирани PHPStorm, Docker и Postman (за генериране на заявки към базата с данни). 

За стартиране на проекта, моля да изпълните следните стъпки (за Windows):
1. Стартиране на Docker;

2. Копиране на url https://github.com/Vi1006/Warehouse-DB.git

3. Отваряне на терминала и изпълняване на следните команди:
	3.1 git clone -b warehouse https://github.com/Vi1006/Warehouse-DB.git - за сваляне на локално копие на проекта (клон warehouse).
	3.2 docker compose build 	- за инсталиране на Docker Images & Containers.
	3.3 docker compose up -d 	- за стартиране на Docker Containers в detached mode.
След тези стъпки проекта вече трябва да бъде стартиран. 

4. За преглед на проекта в PHPStorm:
	4.1 Отваряте PHPStorm
	4.2 File -> Open -> навигирате до директория където са се запазили git clone файловете. Името на папката е Warehouse-DB.
При успешно стартиране на проекта, в браузъра успешно следва да се зареди страницата http://localhost:8080/

5. Зареждане на данни в DB. В терминала изпълняваме командите:
	5.1 docker exec -it laravel /bin/bash 	- за влизане в контейнер Laravel в Docker;
	5.2 php artisan migrate:fresh --seed 	- за мигриране на базата с данни и импортиране на данни във всяка таблица (10 реда на таблица)
	
6. За визуализиране на DB в PHPStorm проекта
	6.1 Добавяме нова база с данни: Database -> бутон + -> Data source -> MariaDB (laravel)
	6.2 User: root / Password: password / Database: laravel
	
В терминала може да извикаме всичките създадени route за заявките с командата: php artisan route:list . Създадените завки са:
- Заявка get за всяка таблица.
- Заявка get(id) за всяка таблица - извиква съответното id от таблицата.
- Заявка post за таблици Addresses, Cities, Clients, Inventories и Orders. С заявката post добавяме нови редове в таблиците.
- Заявка put(id) за таблици Addresses, Cities, Clients, Orders. С тази заявка може да променяме съответния ред от таблицата.
- Заявка delete за таблици Addresses и Cities - за изтриване на редове по id от таблицата.
