# Adeldev Patterns

Brique universelle (méthode : `~/dev/adeldev-wp/METHODE.md`, §3.3). Une bibliothèque de
**sections de page prêtes à modifier**, faites uniquement de blocs natifs, **sans aucun
style propre** : elles prennent l'apparence du thème actif (un enfant de Twenty
Twenty-Five). Insérées, elles appartiennent à la page : le client modifie tout.

Aucune dépendance. La section « Coordonnées » utilise les liaisons
d'[adeldev-organisation](https://github.com/AdelMahjoub/adeldev-organisation) ; sans lui,
ses blocs affichent leur texte d'exemple.

## Les sections

| Slug | Catégorie | Contenu |
|---|---|---|
| `hero-centre` | Bannières | Sur-titre, titre H1, introduction, deux boutons, centrés |
| `hero-image` | Bannières | La même chose à côté d'une image |
| `hero-cover` | Bannières | La même chose sur une image de fond (couverture) |
| `section-header` | Texte | Sur-titre, titre, introduction |
| `text-image` | Texte | Image, titre, deux paragraphes, bouton |
| `faq` | Texte | En-tête et quatre questions (`core/details`) |
| `cards` | Services | En-tête et trois cartes encadrées |
| `features` | Services | En-tête et quatre bénéfices |
| `steps` | Services | En-tête et quatre étapes numérotées |
| `stats` | À propos | Quatre chiffres clés |
| `reassurance` | À propos | Bandeau de quatre engagements |
| `logos` | À propos | Titre et galerie de logos non recadrés |
| `testimonials` | Témoignages | Titre et trois citations |
| `gallery` | Galerie | En-tête et galerie de trois colonnes |
| `cta` | Appel à l'action | Titre, phrase, deux boutons, fond contrasté (`section-5`) |
| `contact` | Contact | Boutons appel / WhatsApp / e-mail et coordonnées liées |
| `latest-posts` | Publications | En-tête et les trois derniers articles |

Les catégories sont celles de WordPress (pas de catégorie maison). Les images sont
des emplacements vides : l'éditeur propose de téléverser, et une image laissée vide
n'est pas affichée.

## Contrat de presets

Une section n'utilise **que** ce que tout enfant de TT5 définit :

| Domaine | Valeurs |
|---|---|
| Couleurs | `contrast`, `accent-4` (texte atténué), `accent-6` (bordures) |
| Espacements | `20` … `80` |
| Tailles de police | `medium`, `large`, `xx-large` |
| Styles de bloc | `is-style-text-annotation` (sur-titre), `is-style-outline` (bouton secondaire), `is-style-section-5` (section contrastée) |

Jamais de famille de police (les titres héritent du thème), de couleur brute ni
d'alignement « gauche » explicite (le début de ligne suit le sens LTR/RTL). Seule
exception : la largeur minimale des colonnes des grilles (`10rem` à `16rem`), qui
décide quand une grille passe à la ligne. Une grille donne toujours **les deux** :
nombre de colonnes et largeur minimale ; avec la largeur seule, WordPress crée des
colonnes vides et la grille ne remplit pas la largeur.

## Outil d'insertion

Les sections s'ajoutent aux patterns de WordPress et du thème, qui restent proposés : on
retrouve celles-ci par leurs catégories ou en cherchant leur nom.

## Patterns synchronisés

Une section qui doit être identique partout (CTA, réassurance…) devient un pattern
synchronisé (« Mes compositions ») :

```bash
ddev wp patterns sync cta --title="Appel à l'action — rendez-vous"
```

```bash
ddev wp patterns list
```

La commande ne crée pas de doublon (méta `_adeldev_pattern`) ; `--update` remplace le
contenu d'un pattern synchronisé déjà créé (les modifications faites sur le site sont
perdues).

## Ajouter une section

Règle de la méthode : une section n'entre ici qu'après avoir servi sur **au moins deux
sites** ; sinon elle va dans les patterns du thème du site.

1. Construire la section dans l'éditeur, avec les seuls presets du contrat.
2. Copier son balisage dans `patterns/<slug>.php` sous l'en-tête habituel (`Title`,
   `Slug: adeldev-patterns/<slug>`, `Categories`, `Keywords`, `Description`,
   `Viewport Width`), en remplaçant chaque texte par
   `<?php esc_html_e( 'Text', 'adeldev-patterns' ); ?>`.
3. Ajouter son titre et sa description à `includes/pattern-headers.php` (WP-CLI ne
   lit pas les en-têtes de patterns d'un plugin).
4. Vérifier dans l'éditeur que chaque bloc est valide :
   `wp.blocks.parse( contenu )` puis `isValid` sur tous les blocs.
5. Régénérer les traductions (ci-dessous).

## Traductions

Textes en anglais avec gettext (domaine `adeldev-patterns`), français dans
`languages/`. Depuis un projet DDEV où le plugin est monté :

```bash
ddev wp i18n make-pot wp-content/plugins/adeldev-patterns wp-content/plugins/adeldev-patterns/languages/adeldev-patterns.pot --exclude=.github
```

puis mettre à jour `adeldev-patterns-fr_FR.po`, et :

```bash
ddev wp i18n make-mo wp-content/plugins/adeldev-patterns/languages
```

```bash
ddev wp i18n make-php wp-content/plugins/adeldev-patterns/languages
```

## Publier une version

Changer `Version` dans l'en-tête **et** `ADELDEV_PATTERNS_VERSION`, committer sur `main`,
pousser : `.github/workflows/release.yml` crée la release `vX.Y.Z`. Les sites la reçoivent
comme une mise à jour normale (`includes/updater.php`, coupée en local).
