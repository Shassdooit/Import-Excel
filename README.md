git clone https://github.com/Shassdooit/Import-Excel
cd Import-Excel

скопировать файл .env.example в .env

cp .env.example .env

запустить контейнеры Sail для установки зависимостей

./vendor/bin/sail up -d

./vendor/bin/sail composer install

./vendor/bin/sail npm install

./vendor/bin/sail npm run dev

файлы для проверки находятся в дериктории excel files

страница импорта excel файла находится по пути [localhost/import](http://localhost/import)
