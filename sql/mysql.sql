-- $Id: schema.mysql,v 1.2 2005/05/04 19:11:53 dbritton Exp $

-- drop table if exists wiki;
-- drop table if exists archive;
-- drop table if exists wikilinks;
-- drop table if exists hitcount;
-- drop table if exists wikiscore;
-- drop table if exists hottopics;


CREATE TABLE wiki_wiki (
        pagename VARCHAR(100) BINARY NOT NULL,
        version INT NOT NULL DEFAULT 1,
        flags INT NOT NULL DEFAULT 0,
        author VARCHAR(100),
        lastmodified INT NOT NULL,
        created INT NOT NULL,
        content MEDIUMTEXT NOT NULL,
        refs TEXT,
        PRIMARY KEY (pagename)
        );

CREATE TABLE wiki_archive (
        pagename VARCHAR(100) BINARY NOT NULL,
        version INT NOT NULL DEFAULT 1,
        flags INT NOT NULL DEFAULT 0,
        author VARCHAR(100),
        lastmodified INT NOT NULL,
        created INT NOT NULL,
        content MEDIUMTEXT NOT NULL,
        refs TEXT,
        PRIMARY KEY (pagename)
        );

CREATE TABLE wiki_wikilinks (
        frompage VARCHAR(100) BINARY NOT NULL,
        topage VARCHAR(100) BINARY NOT NULL,
        PRIMARY KEY (frompage, topage)
        );

CREATE TABLE wiki_hitcount (
        pagename VARCHAR(100) BINARY NOT NULL,
        hits INT NOT NULL DEFAULT 0,
        PRIMARY KEY (pagename)
        );

CREATE TABLE wiki_wikiscore (
        pagename VARCHAR(100) BINARY NOT NULL,
        score INT NOT NULL DEFAULT 0,
        PRIMARY KEY (pagename)
        );


-- tables below are not yet used

CREATE TABLE wiki_hottopics (                
        pagename VARCHAR(100) BINARY NOT NULL,
        lastmodified INT NOT NULL,
        PRIMARY KEY (pagename, lastmodified)
        );
