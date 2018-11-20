Installation and configuration of Zabbix server and agents for Ubuntu (16.04 tested)
====================================================================================
  
Playbook for install and configure Zabbix server and Zabbix agents
  
Ansible's hosts.yml are provided hosts and groups for Zabbix server. 
Check default variables! 
  
You can easily deploy Zabbix with such hosts.yml for example (change hostnames):
  
[app]  
test-app.example.com  
[db]  
test-db.example.com  
[monitoring]  
zabbix.example.com  
  
This role will create host groups from groups in ansible host file and hosts for this groups. In zabbix_templates var you can assign templates for these hosts.

## Role Variables
--------------

#### Zabbix version (supported by Zabbix: 3.0, 3.1, 3.2, 3.4, 3.5, 4.0)
```zabbix_version: "4.0"```

#### Zabbix minor version (supported 2 for 4.0 and 1 for older versions)
```zabbix_version_postfix: 2```

#### Title of frontend
```zabbix_web_title   : "{{ project_name|default('Application') }}"```

#### Additional web user username
```zabbix_web_user    : "user"```

#### Additional web user password
```zabbix_web_password: "user"```

#### Access to mysql database
```
zabbix_mysql_user    : zabbix
zabbix_mysql_password: zabbix  
zabbix_mysql_db      : zabbix  
```
#### IP-address of Zabbix-server for Zabbix-agents
```zabbix_server_ip: "{{ hostvars[groups['monitoring'][0]]['ansible_default_ipv4']['address'] }}"  ```

#### Zabbix-server configuration options
```
zabbix_server_config_options:
  - option: DBHost
    value : ""
  - option: DBName
    value : "{{ zabbix_mysql_db }}"
  - option: DBUser
    value : "{{ zabbix_mysql_user }}"
  - option: DBPassword
    value : "{{ zabbix_mysql_password }}"
  - option: LogFileSize
    value : 256
```
#### Default value of data checkings
```zabbix_items_default_delay: 5m```

#### Templates for data gathering - example:
```
zabbix_templates:  
  - name  : Linux server  
    desc  : General, non-specific checkings  
    groups: "{{ groups|difference(['all','ungrouped']) }}"  
    check_items:  
      - name      : "Used space on root"  
        key       : "vfs.fs.size[/,pused]"  
        value_type: 4  
        triggers  :  
          - name      : "Too much space is used (more than 80%) on {HOST.NAME}"  
            priority  : 2  
            postfix   : "last(#3)"  
            logic     : ">80"  
```
