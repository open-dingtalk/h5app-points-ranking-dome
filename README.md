# 积分排名Demo

### **积分排名简介**

积分是企业数字化的标志，是衡量一个员工的工具。积分排名基于组织自身的通讯录、考勤、日志、运动等开放API，为企业组织提供数字化解决方案。

企业可通过创建内部应用，根据不同维度的（日志、考勤、运动）等，进行员工或部门员工的积分排名，或进行数据统计等能力，实现企业员工的高效管理，及数字化转型。

**目录结构**
```
 ├── README.md
 ├── dingapi
 │   ├── Autoloader.php		  自动加载
 │   ├── Dingconfig.php		  全局配置文件
 │   ├── api		          接口目录
 │   ├── index.php		  初始化过程
 │   └── request
 │       └── Http.php
 ├── index.html			  主页面
 └── src		          静态资源
```


### 研发环境准备

1. 需要有一个钉钉注册企业，如果没有可以创建：https://oa.dingtalk.com/register_new.htm#/

2. 成为钉钉开发者，参考文档：https://developers.dingtalk.com/document/app/become-a-dingtalk-developer

3. 登录钉钉开放平台后台创建一个H5应用： https://open-dev.dingtalk.com/#/index

4. 配置应用

   配置开发管理，参考文档：https://developers.dingtalk.com/document/app/configure-orgapp

    - **此处配置“应用首页地址”需公网地址，若无公网ip，可使用钉钉内网穿透工具：**

      https://developers.dingtalk.com/document/resourcedownload/http-intranet-penetration

![image-20210706171740868](https://img.alicdn.com/imgextra/i4/O1CN01C9ta8k1L3KzzYEPiH_!!6000000001243-2-tps-953-517.png)



配置相关权限：https://developers.dingtalk.com/document/app/address-book-permissions

本demo使用接口相关权限：

“通讯录部门信息读权限”、“通讯录部门成员读权限”、“查询企业员工日志权限”、“钉钉健康数据查询权限”、“查询企业考勤数据权限”

![image-20210706172027870](https://img.alicdn.com/imgextra/i3/O1CN016WCr6428wDdBhkWi6_!!6000000007996-2-tps-1358-571.png)

**开发准备**

- 启动配置修改（必选，修改AppKey和AppSecret）

![](https://img.alicdn.com/imgextra/i2/O1CN012q98Bd24PSsLXOVcT_!!6000000007383-0-tps-322-267.jpg)

- 修改前端页面样式（可选）

![](https://img.alicdn.com/imgextra/i3/O1CN01rSlkp322fNPB0WlkG_!!6000000007147-0-tps-353-111.jpg)

- 修改接口调用方式（可选）

![](https://img.alicdn.com/imgextra/i3/O1CN010CYR2j26aZiU8Ff3l_!!6000000007678-0-tps-269-306.jpg)

###  启动项目

- 启动应用（php）
- 移动端/PC钉钉工作台，进入应用

### 效果展示

- 页面展示

![](https://img.alicdn.com/imgextra/i3/O1CN01h3erZc1GNQK8qH6E0_!!6000000000610-2-tps-902-533.png)

- 部门列表

![](https://img.alicdn.com/imgextra/i3/O1CN01LZEdCx22NVxMxnC7w_!!6000000007108-2-tps-900-332.png)

- 数据展示

![](https://img.alicdn.com/imgextra/i4/O1CN01LpSw401te9o9iGOGn_!!6000000005926-2-tps-851-265.png)

### 参考文档

1. 获取企业内部应用access_token，文档链接：https://developers.dingtalk.com/document/app/obtain-orgapp-token
2. 获取企业内员工打卡结果，文档链接：https://developers.dingtalk.com/document/app/open-attendance-clock-in-data
3. 获取部门列表，文档链接：https://developers.dingtalk.com/document/app/obtain-the-department-list-v2
4. 获取部门用户基础信息，文档链接：https://developers.dingtalk.com/document/app/queries-the-simple-information-of-a-department-user
5. 获取用户发送日志的概要信息，文档链接：https://developers.dingtalk.com/document/app/view-log-summary-data
6. 批量获取钉钉运动数据，文档链接：https://developers.dingtalk.com/document/app/queries-the-number-of-dingtalk-movement-steps-of-multiple-users

