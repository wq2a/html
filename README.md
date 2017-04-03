# html

### Configuration
#### application/config/config.php
$config['base_url'] = 'http://example.com/';//''; this is for mac 

### ssmpt
- https://support.google.com/accounts/answer/6010255?hl=en
- https://support.google.com/accounts/answer/6009563
- sudo vi /etc/ssmtp/ssmtp.conf

  ```
  root=user@gmail.com
  mailhub=smtp.gmail.com:587
  AuthUser=user@gmail.com
  AuthPass=pass
  UseTLS=YES
  UseSTARTTLS=YES
  AuthMethod=LOGIN
  rewriteDomain=gmail.com
  FromLineOverride=YES
  ```

- echo "Test message from Linux server using ssmtp" | sudo ssmtp -vvv ss@x.com

