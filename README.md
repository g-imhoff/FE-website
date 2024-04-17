
# Future Expansion Website

Pour mon projet de Programmation Web2, j'ai décidé de faire un site d'article en lien avec une de mes passions que je pratique à côté de mes études

## Contexte
Je fais des vidéos tuto youtube ([Future Expansion](https://www.youtube.com/@futurexpansion)) aidant les gens a faire leur propre musiques, j'ai donc essayer de faire un site d'article qui permet d'accompagner les vidéos d'un article sur ce site.

## Fonctionnalités

- Possibiliter de créer des articles directement depuis pour le site : 

Cette fonctionnalité est reserver au admin du site, j'ai décidé de permettre la dissociation d'un utilisateur normal et d'un administrateur par le biais de la données admin stocker dans la base de données, si 1 alors tu es un admin, sinon tu ne l'est pas

j'ai créer a l'avance un utilisateur admin qui : 

- nom d'utilisateur : root
- mot de passe : root

la page d'administration est disponible depuis la page account.php

- Supporte la langue française et anglaise
- Fonctionnalité Load More pour afficher toutes les lecon depuis la page all-lesson.php
- Responsive


## Lancer localement

Cloner le projet

```bash
  git clone git@git.unistra.fr:gimhoff/project_web2_guillaumeimhoff.git
```

Allez dans le dossier du projet

```bash
  cd project_web2_guillaumeimhoff
```

Lancer en local le site web

```bash
  php -S 127.0.0.1:8000
```

