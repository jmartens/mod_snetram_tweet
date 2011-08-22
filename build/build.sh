#!/bin/sh
wget https://raw.github.com/seaofclouds/tweet/master/tweet/jquery.tweet.js -O js/jquery.tweet.js
wget https://raw.github.com/seaofclouds/tweet/master/tweet/jquery.tweet.css -O css/jquery.tweet.css
cd ../
tar -czf build/mod_snetram_tweet.tgz index.html mod_snetram_tweet.xml mod_snetram_tweet.php helper.php css/ js/ language/ tmpl/
tar tvzf build/mod_snetram_tweet.tgz