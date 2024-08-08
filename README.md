
Копируем репазиторий  git clone https://github.com/Shassdooit/Import-Excel

Переходим в корневую дерикторию проекта

Делаем скрипт исполняемым chmod +x setup.sh запускаем скрипт ./setup.sh

После того как скрипт отработал запускаем сервер

./vendor/bin/sail artisan serve

Запускаем Vite

./vendor/bin/sail npm run dev

файлы для проверки находятся в дериктории excel files

страница импорта excel файла находится по пути [localhost/import](http://localhost/import)
