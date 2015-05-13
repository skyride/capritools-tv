#Capri Tools - TV

Provides a very simple web front-end to an Nginx server running [nginx-rtmp-module](https://github.com/arut/nginx-rtmp-module) configured with HLS. Nginx must be configured to have the playlist expire, or all streams will remain until the files are deleted manually.