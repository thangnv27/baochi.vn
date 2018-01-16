== Requirements

- PHP 5.2+
- SPL extension (standard)
- Memcache & Memcached

== CHMOD if permission denied

- 777 for directory: database, tmp, upload, app/cache
- 666 for all of files in "database" directory

== Application configuration
Config in "app/config/config.php"

Web chi hoat dong o http://nguoiduatin.net 
Neu muon doi thanh http://www.nguoiduatin.net thi thay doi "site_url" trong file config.php
Clear memcached: http://da.nguoiduatin.net/welcome/clear_memcached

== Cron configuration

*/10 * * * * wget -O - http://nguoiduatin.net/dashboard/post/get_from_rss/?req=0 > /dev/null 2>&1
*/10 * * * * wget -O - http://nguoiduatin.net/dashboard/post/get_from_rss/?req=1 > /dev/null 2>&1
*/10 * * * * wget -O - http://nguoiduatin.net/dashboard/post/get_from_rss/?req=2 > /dev/null 2>&1
*/10 * * * * wget -O - http://nguoiduatin.net/dashboard/post/get_from_rss/?req=3 > /dev/null 2>&1
0 0 * * *   wget -O - http://nguoiduatin.net/dashboard/post/delete_old_posts /dev/null 2>&1
* */1 * * * wget -O - http://nguoiduatin.net/dashboard/rss/check_rss /dev/null 2>&1
*/3 * * * * wget -O - http://nguoiduatin.net/welcome/ie7_generate_web_hay > /dev/null 2>&1

* * */1 * * wget -O - http://nguoiduatin.net/cronjob/generate_menu > /dev/null 2>&1
* */1 * * * wget -O - http://nguoiduatin.net/cronjob/generate_xml_sitemap > /dev/null 2>&1
* * */7 * * wget -O - http://nguoiduatin.net/cronjob/remove_tmp_file > /dev/null 2>&1
*/3 * * * * wget -O - http://nguoiduatin.net/dashboard/post/mobile_generate_posts_by_category/?req=0 > /dev/null 2>&1
*/3 * * * * wget -O - http://nguoiduatin.net/dashboard/post/mobile_generate_posts_by_category/?req=1 > /dev/null 2>&1
*/3 * * * * wget -O - http://nguoiduatin.net/dashboard/post/mobile_generate_posts_by_category/?req=2 > /dev/null 2>&1
*/3 * * * * wget -O - http://nguoiduatin.net/dashboard/post/mobile_generate_posts_by_category/?req=3 > /dev/null 2>&1


== Replace domain name with sql query

UPDATE `links` SET `thumbnail` = replace(`thumbnail`, 'http://yeah5.com', 'http://nguoiduatin.net');
UPDATE `languages` SET `flag` = replace(`flag`, 'http://yeah5.com', 'http://nguoiduatin.net');
UPDATE `posts` SET `thumbnail` = replace(`thumbnail`, 'http://yeah5.com', 'http://nguoiduatin.net');
UPDATE `statistics_useronline` SET `url` = replace(`url`, 'http://yeah5.com', 'http://nguoiduatin.net');
UPDATE `statistics_useronline` SET `url` = replace(`url`, 'http://www.yeah5.com', 'http://nguoiduatin.net');
UPDATE `statistics_useronline` SET `referred` = replace(`referred`, 'http://yeah5.com', 'http://nguoiduatin.net');
UPDATE `statistics_useronline` SET `referred` = replace(`referred`, 'http://www.yeah5.com', 'http://nguoiduatin.net');
UPDATE `statistics_visitor` SET `referred` = replace(`referred`, 'http://yeah5.com', 'http://nguoiduatin.net');
UPDATE `statistics_visitor` SET `referred` = replace(`referred`, 'http://www.yeah5.com', 'http://nguoiduatin.net');