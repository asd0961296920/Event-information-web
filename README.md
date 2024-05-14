# Event-information-web
專案簡介:

這是一個基於 Laravel 和 Vue 框架的網站，其功能是自動搜尋各地區的活動資訊。這個網站遵循了前後端分離的開發模式，前端使用 Vue 來實現用戶界面和互動，而後端則使用 Laravel 來處理數據邏輯和與數據庫的交互。

爬網站有兩種模式，分別是傳統的cURL請求模式，以及通過Node.js的Puppeteer套件使用瀏覽器的完整模式

另外，要使用完整模式的Node.js需要另外部屬，相關專案在另外一個庫

[https://github.com/asd0961296920/EventInformationWeb-node.js](https://github.com/asd0961296920/EventInformationWeb-node.js)

網站已部屬上線:

[https://twgather.techscomet.com](https://twgather.techscomet.com/)

歡迎來逛逛~

使用說明：

.env檔案基本資料需要設定

php artisan area 指令進行基本縣市資料建立

php artisan migrate 指令進行資料表建立


***
