/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2017/5/25 16:15:40                           */
/*==============================================================*/


drop table if exists ttxw_column;

drop table if exists ttxw_comment;

drop table if exists ttxw_menu;

drop table if exists ttxw_news;

drop table if exists ttxw_role;

drop table if exists ttxw_sysuser;

drop table if exists ttxw_user;

/*==============================================================*/
/* Table: ttxw_column                                           */
/*==============================================================*/
create table ttxw_column
(
   column_id            int(10) not null auto_increment comment '栏目编号',
   column_name          varchar(255) comment '栏目名称',
   comment              varchar(255) comment '备注',
   primary key (column_id)
);

alter table ttxw_column comment '栏目表';

/*==============================================================*/
/* Table: ttxw_comment                                          */
/*==============================================================*/
create table ttxw_comment
(
   comment_id           int(10) not null auto_increment comment '评论编号',
   user_id              int(10) not null comment '用户编号',
   news_id              int(10) comment '新闻编号',
   comment_fid          int(10) comment '评论编号',
   comment_date         date comment '评论日期',
   comment_content      varchar(255) comment '评论内容',
   comment              varchar(255) comment '备注',
   del_flag             int(4) comment '删除标志',
   primary key (comment_id)
);

/*==============================================================*/
/* Table: ttxw_menu                                             */
/*==============================================================*/
create table ttxw_menu
(
   menu_id              int(10) not null auto_increment comment '菜单编号',
   menu_fid             int(10) comment '菜单上级编号',
   menu_name            varchar(255) comment '菜单名称',
   menu_url             varchar(255) comment '菜单绑定地址',
   comment              varchar(255) comment '备注',
   primary key (menu_id)
);

alter table ttxw_menu comment '菜单表';

/*==============================================================*/
/* Table: ttxw_news                                             */
/*==============================================================*/
create table ttxw_news
(
   news_id              int(10) not null auto_increment comment '新闻编号',
   sysu_id              int(10) comment '系统用户编号',
   column_id            int(10) comment '栏目编号',
   news_date            date comment '新闻发布日期',
   news_title           varchar(255) comment '新闻标题',
   news_content         text comment '新闻内容',
   comment              varchar(255) comment '备注',
   del_flag             int(4) comment '删除标志',
   primary key (news_id)
);

alter table ttxw_news comment '新闻表';

/*==============================================================*/
/* Table: ttxw_role                                             */
/*==============================================================*/
create table ttxw_role
(
   role_id              int(10) not null auto_increment comment '角色编号',
   role_name            varchar(255) comment '角色名称',
   role_menus           varchar(255) comment '绑定菜单（;分隔）',
   comment              varchar(255) comment '备注',
   primary key (role_id)
);

alter table ttxw_role comment '角色表';

/*==============================================================*/
/* Table: ttxw_sysuser                                          */
/*==============================================================*/
create table ttxw_sysuser
(
   sysu_id              int(10) not null auto_increment comment '系统用户编号',
   role_id              int(10) comment '角色编号',
   sysu_photo           varchar(255) comment '系统用户头像',
   sysu_account         varchar(255) comment '用户帐号',
   sysu_name            varchar(255) comment '用户名',
   sysu_pwd             varchar(255) comment '用户密码',
   sysu_date            varchar(255) comment '用户创建日期',
   comment              varchar(255) comment '备注',
   primary key (sysu_id)
);

alter table ttxw_sysuser comment '系统用户表';

/*==============================================================*/
/* Table: ttxw_user                                             */
/*==============================================================*/
create table ttxw_user
(
   user_id              int(10) not null auto_increment comment '用户编号',
   user_name            varchar(255) not null comment '用户名称',
   user_photo           varchar(255) comment '用户头像',
   user_pwd             varchar(255) not null comment '用户密码',
   user_account         varchar(255) not null comment '用户帐号',
   user_follow          varchar(255) comment '用户关注头条号id集（;隔开）',
   user_news            varchar(255) comment '收藏新闻id集（;隔开）',
   comment              varchar(255) comment '备注',
   primary key (user_id)
);

alter table ttxw_user comment '用户表';

alter table ttxw_comment add constraint FK_Reference_1 foreign key (user_id)
      references ttxw_user (user_id) on delete restrict on update restrict;

alter table ttxw_comment add constraint FK_Reference_6 foreign key (news_id)
      references ttxw_news (news_id) on delete restrict on update restrict;

alter table ttxw_comment add constraint FK_Reference_7 foreign key (comment_fid)
      references ttxw_comment (comment_id) on delete restrict on update restrict;

alter table ttxw_menu add constraint FK_Reference_2 foreign key (menu_fid)
      references ttxw_menu (menu_id) on delete restrict on update restrict;

alter table ttxw_news add constraint FK_Reference_4 foreign key (sysu_id)
      references ttxw_sysuser (sysu_id) on delete restrict on update restrict;

alter table ttxw_news add constraint FK_Reference_5 foreign key (column_id)
      references ttxw_column (column_id) on delete restrict on update restrict;

alter table ttxw_sysuser add constraint FK_Reference_3 foreign key (role_id)
      references ttxw_role (role_id) on delete restrict on update restrict;

