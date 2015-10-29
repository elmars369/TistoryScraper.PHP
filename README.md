PHP script that downloads images from Tistory sites.

Arguments needed:
    1. Directory (pictures will be saved here, inside a folder named after the provided URL)'.PHP_EOL
    2. URL (the tistories URL)'.PHP_EOL
    3. Number > 0 (number that denotes where to download from; ex. 16 will download pictures from URL/16)'.PHP_EOL
    4. Number >= 2nd arg [optional] (if enetered, will download from all urls starting from the 3rd arg through the 4th arg (including))'.PHP_EOL;

Examples:
    >php.exe -f scraper.php -- C:\Users\User\Desktop http://www.20150421.com/ 5
    >php.exe -f scraper.php -- C:\Users\User\Desktop ohmy8irl.tistory.com 1 40
