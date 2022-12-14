# CSS Klassen
## Inhalt

[Inhalt](notes.md)

## Einleitungstext
Hervorgehobener Einleitungstext in einem Beitrag (Post) erreicht man mit der Klasse **"leadin"**
Innerhalb des Beitrags legt man einen **Text Block** an und in dem Tab **Text** wrapped man den Einleitungstext in ein
**div** mit der Klasse **"leadin"**

*(Styles hierzu sind in der **typography.scss** zu finden)*

    <div class="leadin">
        Mein Text ...
    </div


## Listen

Listen ohne Nummerierung oder Bindestriche bekommen die Klasse **"list-unstyled"**

*(Styles hierzu sind ein Teil des Bootstrap CSS Framework das wir benutzen)*

    <ul class="list-unstyled">
        <li></li>
        <li></li>
         ..
    </ul>

Listen mit Checkmark Icons bekommen die Klasse **"icon-checklist"**

*(Styles hierzu sind in der **_ins-icons.scss** zu finden)*

    <ul class="list-unstyled icons-checklist">
        <li></li>
        <li></li>
        ...
    </ul>

Farbige Icons in unseren Styleguide-Farben bekommen die Klasse **"icon-farbname"** z.B. **"icon-yellow"**
<br>(derzeit existiert nur die Klasse **"icon-yellow"** kann aber nach Bedarf erweitert werden)

*(Styles hierzu sind in der **_ins-icons.scss** zu finden)*

    <ul class="list-unstyled icons-checklist icons-yellow">
        <li></li>
        <li></li>
        ...
    </ul>

## Info-Boxen
Info Boxen zeichnen sich durch ein gleichbleibendes Padding, Margins nach oben, einem Border-Radius, farbiger Umrandung,
Überschriften in der Schriftart **Lato Black** und der Möglichkeit einzelne Worte mit dem Tag **<mark></mark>**
hervorzuheben aus.

*(Styles hierzu sind in der **_ins-info-box.scss** zu finden)*

    <div class="info-box">
        <h2><mark>Fazit:</mark> Mit einem gut gepflegten Unternehemensprofil haben Sie der Konkurrenz etwas voraus</h2>
    </div>

### Mehrere Info-Boxen nebeneinander
Mehrere Info-Boxen nebeneinander mit farbigem Hintergrund benötigen evtl. eine "Lücke", damit nicht die gesamte Row den
farbigen Hintergrund erhält. Hierzu ist es erforderlich der Row bzw. dem Elternelement die Klasse **"info-box-container"**
zu geben und den "Kind-Elementen" im CMS der "Spalte" die Klassen **info-box bg-*farbvariante*** zu geben.
Optional kann den Kindelementen die Klasse **"no-border-radius"** gegeben werden, um nicht die für Info-Boxen gestalteten
abgerundeten Ecken zu erhalten.

    <div class="info-box-container">
        <div class="info-box bg-aquamarin-20 no-border-radius">
        <div class="info-box bg-aquamarin-20 no-border-radius">
    </div>

## Farbige Hintergründe
*(Styles hierzu sind in der **_ins-bg-colors.scss** zu finden)*

Durch das setzen der Klasse **"bg-farbname"** kann man den Hintergrund mit einer Farbe unseres Styleguides versehen.
<br>(Auch hier existiert derzeit nur wenige Klassen
- **bg-yellow**
- **bg-aquamarin-20**
- **bg-white**

diese können bei Bedarf um weitere Farben ergänzt werden.)
Die Farbwahl des Hintergrundes wirkt sich ebenfalls auf die Textfarbefarbe der Überschriften h1-h4 aus. So sind diese
bei der Klasse **"bg-yellow"** weiß, während sie bei den Klassen **"bg-white"** oder **"bg-aquamarin-20"** in ein
dunkles Grau wechseln.

    <div class="info-box bg-yellow">
        <h2><mark>Fazit:</mark> Mit einem gut gepflegten Unternehemensprofil haben Sie der Konkurrenz etwas voraus</h2>
    </div>

## Farbige Ränder
*(Styles hierzu sind in der **_ins-border.scss** zu finden)*

Durch das setzen der Klasse **"border-farbname"** kann man ein Element mit einer Randfarbe (Border) aus unseres Styleguide versehen.
<br>(Auch hier existiert derzeit nur wenige Klassen)
- **border-yellow**
- **border-aquamarin-20**
- **border-red**
- **border-darkblue**

diese können bei Bedarf um weitere Farben ergänzt werden.)
Die Farbwahl der Border ist mit 6px Breite definiert und einem border-radius von 4px. Eine Kombination mit den Klassen
**border-farbname** oder **no-border-radius** kann hier zu einer gewünschten Variation verhelfen.

*(Beispiel:)*

    <div class="bg-white border-yellow no-border-radius">
        ...
    </div>

Diese Kombination der Klassen sollte eine Box mit gelber Border ohne abgerundeten Ecken bewirken.






