# Sign it 

## A propros de Signit

Sign-it est une application de gestion de réunion. Cette application permet de créer et éditer des réunions, envoyer des invitations de participation. Elle créera aussi à la clôture de la réunion, une fiche de présence avec les informations de celle-ci. 

## Installation du projet

Pour installer le projet suivez ces instructions
- `git clone ssh://localhost:6611/TMED/SignIt tmed-signit`

Dans le fichier du projet, Après avoir modifier le fichier `.env.example` en `.env`, suivre les instruction tel que : 
- `composer install `
- `npm install `
- `npm run dev`

## Interfaces 

### Global Interface 


Un Utilisateur non enregistré pourra :
- Rejoindre une réunion avec ses informations personnelles **seulement si la réunion a des privilèges public**. 
  
Il ne pourra par contre pas gérer sa participation et devra passer par l'administrateur de la réunion pour cela. **Attention une personne public peut s'enregistré plusieurs fois pour la meme réunion!**


### User Interface

L'utilisateur simple pourra : 
- Afficher les réunions auxquelles il participe ou a participé. 
- Avoir accès aux information de la réunion. 
- Avoir accès aux réunions privées. 
- Se désinscrire d'une réunion si celle-ci n'est pas encore cloturée. 
  
Un utilisateur ne pourra pas s'engistrer 2x sur la même réunion.

### Admin Interface

L'administateur pourra :
- Créer/éditer/supprimer des réunions
- Gérer les participants sur une réunion
- Envoyer les liens d'invitation
- Cloturer une réunion
- Gérer les pdf de présence





  

