#Proxy LCD Bundle

Symfony3 handler for Proxy LCD project. 
Hook to dump() and send content to Proxy LCD.
Works nicely in docker. 

[NodeHD44780](https://github.com/bkosciow/esp_remote_lcd) - remote lcd

![display](https://koscis.files.wordpress.com/2017/01/nodemcu_screen.jpg)

[Proxy LCD](https://github.com/bkosciow/proxy_lcd) desktop app

![main window](https://koscis.files.wordpress.com/2017/02/screen1.png)

##Default configuration

    hone_proxy_lcd:
      proxy_ip: localhost
      proxy_port: 5054
      dump:
        enabled: false
        mode: stream
      
Without IP bundle is disabled. Only mode stream available for now.
For docker env set host IP.

Minimal configuration:

    hone_proxy_lcd:
      proxy_ip: 192.168.1.102
      dump:
        enabled: true