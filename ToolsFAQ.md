#Cette FAQ est là pour apporter de l'aide sur l'environnement de développement

# Introduction #

Ce projet a été développé en utilisant Netbeans et Mercurial pour la gestion des sources. D'autres IDEs sont utilisables bien sûr.

# Details #

_Question_ j'ai bien initialisé mon dépôt local depuis les sources Google Code, mais je n'ai pas accès aux commandes Zend (menu contextuel sur le nom du projet)

_Réponse_ Un projet Zend Framework comporte un fichier .zfproject.xml créé à la racine de l'arborescence. Ce fichier est créé par l'outil zf. Or il n'est pas pris en charge par NetBeans dans la gestion de sources ! Du coup, il n'était pas présent sur Google Code.

_Question_ Netbeans n'affiche pas le fichier .zfproject.xml dans l'IDE

_Réponse_ Il faut aller dans le menu Tools / Options, puis Miscellaneous / Files. Dans Ignored Files Pattern, mettre : <sup>(CVS|SCCS|vssver.?\.scc|#.*#|%.*%|_svn)$|~$|</sup>\.(?!(htaccess|zfproject\.xml)$).