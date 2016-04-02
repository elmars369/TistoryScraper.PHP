PHP script that downloads images from Tistory sites.


Table of contents
    1. Arguments needed
    2. Number format
    3. Sorting options
    4. Tested Tistories
    5. Examples
    6. Other notes


1. Arguments needed
    1. Directory (pictures will be saved here, inside a folder named after the provided URL)
    2. URL (the Tistory's URL)
    3. Numbers (numbers that denote where to download from)
    4. Sorting option [optional] (if enetered, will determine how the pictures are stored)


2. Number format
    Accepts an array of numbers that are separated by a comma (","):
        number,number,number,...,number  (examples: "1,2,3,4,5"; "10,15,20,25,30")
    Also accepts intervals formated as follows:
        number-number  (examples: "1-400"; "2-12"; "10-59")
    Both can be combined in any order, for example:
        "1,5,10,20-30,99,32"; "10-20,45,35,25,50-90,3"


3. Sorting options
    +-------------+-----------------------------------------------------+-----------------------------------------------+
    |    Value    |                   Description                       |               Structure example:              |
    +-------------+-----------------------------------------------------+-----------------------------------------------+
    |  "default"  |  Use the default sorting option, each Tistory       |                                               |
    |             |  has it's own (check "4. Tested Tistories").        |                                               |
    |             |  Will be used if no fourth argument is passed       |                                               |
    |             |  or if the passed argument is invalid.              |                                               |
    +-------------+-----------------------------------------------------+-----------------------------------------------+
    |   "date"    |  Puts pictures in sub-folders by the Tistory's      |  C:/.../tistory.com/151024/151024.jpg         |
    |             |  provided date. Default option for most Tistories.  |  C:/.../tistory.com/151024/151024(2).jpg      |
    |             |                                                     |  C:/.../tistory.com/151024/151024(3).jpg      |
    |             |                                                     |  ...                                          |
    |             |                                                     |  C:/.../tistory.com/151103/151103.jpg         |
    |             |                                                     |  C:/.../tistory.com/151103/151103(2).jpg      |
    |             |                                                     |  C:/.../tistory.com/151103/151103(3).jpg      |
    |             |                                                     |  ...                                          |
    |             |                                                     |  C:/.../tistory.com/151130/151130.jpg         |
    |             |                                                     |  C:/.../tistory.com/151130/151130(2).jpg      |
    |             |                                                     |  ...                                          |
    +-------------+-----------------------------------------------------+-----------------------------------------------+
    |  "members"  |  Puts pictures in sub-folders by the Tistory's      |  C:/.../20150421.com/Arin/150511.jpg          |
    |             |  provided member names. Most Tistories do not       |  C:/.../20150421.com/Arin/150511(2).jpg       |
    |             |  have these.                                        |  C:/.../20150421.com/Arin/150511(3).jpg       |
    |             |                                                     |  C:/.../20150421.com/Arin/150603.jpg          |
    |             |                                                     |  C:/.../20150421.com/Arin/150603(2).jpg       |
    |             |                                                     |  ...                                          |
    |             |                                                     |  C:/.../20150421.com/HYOJUNG/150511.jpg       |
    |             |                                                     |  C:/.../20150421.com/HYOJUNG/150511(2).jpg    |
    |             |                                                     |  C:/.../20150421.com/HYOJUNG/150716.jpg       |
    |             |                                                     |  C:/.../20150421.com/HYOJUNG/150716(2).jpg    |
    |             |                                                     |  C:/.../20150421.com/HYOJUNG/150716(3).jpg    |
    |             |                                                     |  C:/.../20150421.com/HYOJUNG/150716(4).jpg    |
    |             |                                                     |  ...                                          |
    +-------------+-----------------------------------------------------+-----------------------------------------------+
    |   "none"    |  Do not use sub-folders at all.                     |  C:/.../all-twice.com/150819.jpg              |
    |             |                                                     |  C:/.../all-twice.com/150819(2).jpg           |
    |             |                                                     |  C:/.../all-twice.com/150819(3).jpg           |
    |             |                                                     |  C:/.../all-twice.com/150901.jpg              |
    |             |                                                     |  C:/.../all-twice.com/150901(2).jpg           |
    |             |                                                     |  C:/.../all-twice.com/150901(3).jpg           |
    |             |                                                     |  C:/.../all-twice.com/150901(4).jpg           |
    |             |                                                     |  ...                                          |
    +-------------------------------------------------------------------------------------------------------------------+


4. Tested Tistories
    +----------------------------------+-----------------------+--------------------------+-----------------------------+
    |             Tistory              |  Default sort option  |    Other sort options    |         Other notes         |
    |                                  |                       |  ("none" works for all)  |                             |
    +----------------------------------+-----------------------+--------------------------+-----------------------------+
    |  http://www.20150421.com/        |       "members"       |       "date"             |                             |
    +----------------------------------+-----------------------+--------------------------+-----------------------------+
    |  http://ohmy8irl.tistory.com/    |       "date"          |                          | Uses Google Drive to store  |
    |                                  |                       |                          | images, needs the extension |
    |                                  |                       |                          | "php_openssl.dll" enabled.  |
    |                                  |                       |                          | See section 6.1.            |
    +----------------------------------+-----------------------+--------------------------+-----------------------------+
    |  http://990618.net/              |       "date"          |                          |                             |
    +----------------------------------+-----------------------+--------------------------+-----------------------------+
    |  http://all-twice.com/           |       "date"          |                          |                             |
    +----------------------------------+-----------------------+--------------------------+-----------------------------+
    |  http://93090312.tistory.com/    |       "date"          |                          |                             |
    +----------------------------------+-----------------------+--------------------------+-----------------------------+

5. Examples
    >php.exe -f scraper.php -- C:\Users\User\Desktop http://www.20150421.com/ 5
    // Downloads pictures from "http://www.20150421.com/5" and stores them in the default manner.

    >php.exe -f scraper.php -- "C:\Users\User\New Folder" ohmy8irl.tistory.com 1-40
    // Downloads pictures from "http://www.20150421.com/1", "http://www.20150421.com/2" ... "http://www.20150421.com/40"
    // and stores them in the default manner.
    // Remember to incase your directory in double quotes if it includes a space.

    >php.exe -f scraper.php -- "C:/Users/User/Desktop" "all-twice.com/" 1,10-13,20 none
    // Downloads pictures from "http://www.20150421.com/1", ".../10", ".../11", ".../12", ".../13", ".../20"
    // and stores them without using sub-folders.


6. Other notes
    6.1. Enabling "php_openssl.dll"
        Some Tistories may require the HTTPS protocol to be used in some way. Make sure to enable it's use
        by going to your PHP's directory and opening the "php.ini" file with a text editor (if there is 
        no "php.ini" file, but rather two other files named "php.ini-development" and "php.ini-production", 
        copy one of them and rename it to "php.ini"). Find the line "extension=php_openssl.dll" and uncomment
        it by removing the ";" symbol in front of the line.
    6.2. Enabling "allow_url_fopen"
        Although usually enabled by default, you might need to enable it if it already is not. Go to your 
        PHP's directory and open the "php.ini" file with a text editor (if there is no "php.ini" file, 
        but rather two other files named "php.ini-development" and "php.ini-production", copy one of them 
        and rename it to "php.ini"). Find the line that includes "allow_url_fopen" and replace it with
        "allow_url_fopen = On".