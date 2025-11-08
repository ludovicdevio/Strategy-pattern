# 🌾 Strategy Pattern - Système d'Analyse de Céréales

![Symfony](https://img.shields.io/badge/Symfony-7.3-000000?style=flat&logo=symfony)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)
![Design Pattern](https://img.shields.io/badge/Design%20Pattern-Strategy-green)

Projet de démonstration illustrant l'implémentation du **Strategy Pattern** dans une application Symfony pour l'analyse de différentes céréales.

## 📋 Table des matières

- [À propos](#-à-propos)
- [Architecture](#-architecture)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Structure du projet](#-structure-du-projet)
- [Utilisation](#-utilisation)
- [Le Strategy Pattern](#-le-strategy-pattern)
- [Technologies utilisées](#-technologies-utilisées)

## 🎯 À propos

Ce projet démontre deux approches de conception pour un système d'analyse de céréales :

1. **Approche naïve (If/Else)** : Utilisation de conditions pour distribuer les tâches
2. **Approche avec Strategy Pattern** : Implémentation propre du pattern de conception Strategy

L'objectif est de comparer ces deux approches et de mettre en évidence les avantages du Strategy Pattern en termes de :
- ✅ Maintenabilité
- ✅ Extensibilité
- ✅ Respect des principes SOLID
- ✅ Testabilité

## 🏗️ Architecture

### Approche actuelle : Strategy Pattern

Le projet utilise le **Strategy Pattern** avec les composants suivants :

```
📦 Service/Pattern/
├── AnalyseInterface.php          # Interface commune (contrat)
├── AnalysePatternService.php     # Context (Manager)
├── AnalyseBleService.php          # Strategy pour le blé
├── AnalyseOrgeService.php         # Strategy pour l'orge
├── AnalyseSeigleService.php       # Strategy pour le seigle
└── AnalyseAvoineService.php       # Strategy pour l'avoine
```

#### 🔑 Composants principaux

**1. Interface `AnalyseInterface`**
```php
interface AnalyseInterface
{
    public function analyser(): string;
    public function supports(string $cereal): bool;
}
```

**2. Services concrets (Strategies)**

Chaque céréale a son propre service implémentant `AnalyseInterface` :
- `AnalyseBleService` - Analyse du blé
- `AnalyseOrgeService` - Analyse de l'orge
- `AnalyseSeigleService` - Analyse du seigle
- `AnalyseAvoineService` - Analyse de l'avoine

**3. Manager `AnalysePatternService` (Context)**

Utilise l'injection de dépendances avec `#[AutowireIterator]` pour récupérer automatiquement tous les services taggés :

```php
public function __construct(
    #[AutowireIterator(tag: 'app.analyse')]
    private readonly iterable $analyseServices
) {}
```

Le manager itère sur les services et délègue l'analyse au service approprié via la méthode `supports()`.

## 🎨 Interface utilisateur

L'application dispose d'une interface web moderne affichant :
- 📊 Grille responsive des analyses effectuées
- ✅ Badge de statut (succès/erreur) pour chaque analyse
- 📈 Statistiques globales (total, réussies, échouées)
- 🎨 Design moderne avec dégradés et animations

## 📦 Prérequis

- PHP >= 8.2
- Composer
- Symfony CLI (recommandé)
- Extensions PHP : `ctype`, `iconv`

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone <repository-url>
cd StrategyPattern
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer l'environnement

```bash
cp .env .env.local
# Ajuster les variables d'environnement si nécessaire
```

### 4. Démarrer le serveur

```bash
symfony server:start
```

Ou avec PHP natif :

```bash
php -S localhost:8000 -t public/
```

## 📁 Structure du projet

```
StrategyPattern/
├── config/               # Configuration Symfony
│   ├── packages/        # Configuration des bundles
│   ├── routes/          # Routes
│   └── services.yaml    # Configuration des services
├── public/              # Point d'entrée web
│   └── index.php
├── src/
│   ├── Controller/
│   │   └── DemoController.php      # Contrôleur principal
│   ├── Service/
│   │   └── Pattern/                # Services avec Strategy Pattern
│   │       ├── AnalyseInterface.php
│   │       ├── AnalysePatternService.php
│   │       ├── AnalyseBleService.php
│   │       ├── AnalyseOrgeService.php
│   │       ├── AnalyseSeigleService.php
│   │       └── AnalyseAvoineService.php
│   └── Kernel.php
├── templates/
│   ├── base.html.twig
│   └── demo/
│       └── index.html.twig         # Interface d'affichage
├── composer.json
└── README.md
```

## 💻 Utilisation

### Accéder à l'application

Ouvrez votre navigateur et accédez à :

```
http://localhost:8001/demo
```

### Ajouter une nouvelle céréale

#### 1. Créer un nouveau service

```php
<?php

namespace App\Service\Pattern;

class AnalyseMaisService implements AnalyseInterface
{
    public function analyser(): string
    {
        return 'Résultat de l\'analyse du maïs';
    }

    public function supports(string $cereal): bool
    {
        return strtolower($cereal) === 'mais';
    }
}
```

#### 2. C'est tout ! 🎉

Grâce à l'**autowiring** et au **tag automatique** (`#[AutoconfigureTag('app.analyse')]`), le nouveau service est automatiquement :
- ✅ Enregistré dans le conteneur de services
- ✅ Taggé avec `app.analyse`
- ✅ Injecté dans `AnalysePatternService`

Aucune modification du manager ou de configuration n'est nécessaire !

## 🎭 Le Strategy Pattern

### Qu'est-ce que le Strategy Pattern ?

Le **Strategy Pattern** est un pattern de conception comportemental qui permet de :
- Définir une famille d'algorithmes
- Encapsuler chacun d'eux
- Les rendre interchangeables

### Avantages

| Aspect | Approche If/Else | Strategy Pattern |
|--------|------------------|------------------|
| **Extensibilité** | ❌ Modification du code existant | ✅ Ajout de nouvelles classes |
| **Principe Open/Closed** | ❌ Violation | ✅ Respecté |
| **Testabilité** | ⚠️ Tests complexes | ✅ Tests unitaires isolés |
| **Lisibilité** | ⚠️ Conditions multiples | ✅ Code clair et structuré |
| **Maintenabilité** | ❌ Difficile à maintenir | ✅ Facile à maintenir |

### Diagramme UML

```
┌─────────────────────────┐
│  AnalyseInterface       │
├─────────────────────────┤
│ + analyser(): string    │
│ + supports(string): bool│
└─────────────────────────┘
            △
            │ implements
            │
    ┌───────┴───────┬───────────┬──────────────┐
    │               │           │              │
┌───┴────────┐ ┌───┴──────┐ ┌──┴───────┐ ┌───┴──────────┐
│ BleService │ │OrgeService│ │SeigleServ│ │AvoineService │
└────────────┘ └───────────┘ └──────────┘ └──────────────┘
                        △
                        │ uses
                        │
           ┌────────────┴──────────────┐
           │ AnalysePatternService     │
           ├───────────────────────────┤
           │ - analyseServices: iterable│
           │ + analyserCereal(string)  │
           └───────────────────────────┘
```

## 🔧 Technologies utilisées

- **Framework** : Symfony 7.3
- **Langage** : PHP 8.2+
- **Template Engine** : Twig
- **ORM** : Doctrine
- **Frontend** : Stimulus.js, Turbo
- **Dependency Injection** : Symfony Container avec AutowireIterator

## 🎓 Concepts mis en œuvre

### Design Patterns
- ✅ **Strategy Pattern** : Encapsulation d'algorithmes interchangeables
- ✅ **Dependency Injection** : Inversion de contrôle

### Principes SOLID
- ✅ **Single Responsibility** : Chaque service a une seule responsabilité
- ✅ **Open/Closed** : Ouvert à l'extension, fermé à la modification
- ✅ **Liskov Substitution** : Les services sont interchangeables via l'interface
- ✅ **Interface Segregation** : Interface simple et ciblée
- ✅ **Dependency Inversion** : Dépendance sur des abstractions

### Fonctionnalités Symfony
- 🏷️ **Service Tags** : `#[AutoconfigureTag('app.analyse')]`
- 🔄 **AutowireIterator** : Injection automatique de collections de services
- 📦 **Autowiring** : Configuration automatique des dépendances
- 🎯 **Attributes PHP 8** : Configuration moderne via attributs

## 📝 Notes de développement

### Service Tagging

L'interface utilise l'attribut `#[AutoconfigureTag]` pour marquer automatiquement tous les services implémentants :

```php
#[AutoconfigureTag('app.analyse')]
interface AnalyseInterface
{
    // ...
}
```

### AutowireIterator

Le manager récupère tous les services taggés via `#[AutowireIterator]` :

```php
public function __construct(
    #[AutowireIterator(tag: 'app.analyse')]
    private readonly iterable $analyseServices
) {}
```

Cela permet une injection dynamique sans configuration YAML explicite.

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :
1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence propriétaire.

## 👨‍💻 Auteur

**Ludovic Dev** - Portfolio Project

---

⭐ Si ce projet vous a aidé à comprendre le Strategy Pattern, n'hésitez pas à mettre une étoile !
