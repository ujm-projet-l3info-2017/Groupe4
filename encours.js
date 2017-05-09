(function() {

    function remplacer(remplace, remplacant){
        var idRt = remplacant.getAttribute('data-id'),
            idRe = remplace.getAttribute('data-id'),
            xhr= new XMLHttpRequest();
            alert(idRt+" et "+idRe);
            xhr.open("GET","http://localhost/Symfony/web/app_dev.php/statisfoot/manage/joueur/remp/"+idRt+"/"+idRe,true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Reussi');
                }
            }

            xhr.send(null);
    }


    function butSimple(el){
        var idB = el.getAttribute('data-type'),
            idJ = el.parentNode.parentNode.parentNode.getAttribute('data-id'),
            idM = el.parentNode.parentNode.parentNode.getAttribute('data-match'),
            idA = 0,
            xhr= new XMLHttpRequest();

        xhr.open("GET","http://localhost/Symfony/web/app_dev.php/statisfoot/manage/joueur/but/"+idJ+"/"+idM+"/"+idB+"/"+idA,true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Reussi');
            }
        }

        xhr.send(null);     

    }


    function butSurAction(el){
        var idB = el.parentNode.parentNode.getAttribute('data-type'),
            idJ = el.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute('data-id'),
            idM = el.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute('data-match'),
            idA = el.getAttribute('data-type'),
            xhr= new XMLHttpRequest();

        xhr.open("GET","http://localhost/Symfony/web/app_dev.php/statisfoot/manage/joueur/but/"+idJ+"/"+idM+"/"+idB+"/"+idA,true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Reussi');
            }
        }

        xhr.send(null);     

    }

    function passeDecisive(el){
        var idJ = el.parentNode.parentNode.parentNode.getAttribute('data-id'),
            idM = el.parentNode.parentNode.parentNode.getAttribute('data-match'),
            idP = el.getAttribute('data-type'),
            xhr= new XMLHttpRequest();

        xhr.open("GET","http://localhost/Symfony/web/app_dev.php/statisfoot/manage/joueur/passe/"+idJ+"/"+idM+"/"+idP,true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Reussi');
            }
        }

        xhr.send(null); 
    }

    var dndHandler = {

        draggedElement: null, // Propriété pointant vers l'élément en cours de déplacement

        applyDragEvents: function(element) {

            element.draggable = true;

            var dndHandler = this; // Cette variable est nécessaire pour que l'événement « dragstart » ci-dessous accède facilement au namespace « dndHandler »

            element.addEventListener('dragstart', function(e) {
                dndHandler.draggedElement = e.target; // On sauvegarde l'élément en cours de déplacement
                e.dataTransfer.setData('text/plain', ''); // Nécessaire pour Firefox
            });

        },

        applyDropEvents: function(dropper) {

            dropper.addEventListener('dragover', function(e) {
                e.preventDefault(); // On autorise le drop d'éléments
                this.className = 'boule dropper draggable drop_hover'; // Et on applique le style adéquat à notre zone de drop quand un élément la survole
            });

            dropper.addEventListener('dragleave', function() {
                this.className = 'boule dropper draggable'; // On revient au style de base lorsque l'élément quitte la zone de drop
            });

            var dndHandler = this; // Cette variable est nécessaire pour que l'événement « drop » ci-dessous accède facilement au namespace « dndHandler »

            dropper.addEventListener('drop', function(e) {

                var target = e.target,
                    draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                    clonedTarget = target.cloneNode(true), //on cree un clone de la cible
                    clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément

                while (target.className.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                    target = target.parentNode;
                }

                target.className = 'boule dropper'; // Application du style par défaut

                var posteRemplace = clonedTarget.getAttribute('data-poste'),
                    posteRemplacant = clonedElement.getAttribute('data-poste');

                    clonedElement.setAttribute('data-poste',posteRemplace);

                    //si le remplaçant est deja titulaire
                if (draggedElement.parentNode.className == 'titulaire') {

                    clonedTarget.className='boule dropper draggable';

                    clonedTarget.setAttribute('data-poste',posteRemplacant);
                }
                else{
                     clonedTarget.className ='boule draggable';
                }
               
                
                target.parentNode.appendChild(clonedElement);

                //clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                dndHandler.applyDropEvents(clonedElement);

                var nom = target.parentNode.nextSibling;
                nom.innerHTML="";
                //on replace le nom du joueur remplacé
                nom.textContent= clonedElement.getAttribute('data-nom')+" "+clonedElement.getAttribute('data-pre');

                var nom2 = draggedElement.parentNode.nextSibling,
                    poste = nom2.nextSibling;

                nom2.innerHTML="";
                poste.innerHTML="";
                //on affecte 
                nom2.textContent = clonedTarget.getAttribute('data-nom')+" "+clonedTarget.getAttribute('data-pre');
                poste.textContent = clonedTarget.getAttribute('data-poste');                

               //alert(target.parentNode.nextSibling);
                draggedElement.parentNode.appendChild(clonedTarget);
                dndHandler.applyDragEvents(clonedTarget); //Nouvelle application des evenements drag

                if (draggedElement.parentNode.className == 'titulaire') {
                    dndHandler.applyDropEvents(clonedTarget);
                }

                target.parentNode.removeChild(target); //suppression de l'element remplacé
                draggedElement.parentNode.removeChild(draggedElement); // Suppression de l'élément d'origine

                remplacer(clonedTarget,clonedElement);

            });

        }

    };

    var elements = document.getElementsByClassName('draggable'),
        elementsLen = elements.length;

    for (var i = 0; i < elementsLen; i++) {
        dndHandler.applyDragEvents(elements[i]); // Application des paramètres nécessaires aux éléments déplaçables
    }

    var droppers = document.getElementsByClassName('dropper'),
        droppersLen = droppers.length;

    for (var i = 0; i < droppersLen; i++) {
        dndHandler.applyDropEvents(droppers[i]); // Application des événements nécessaires aux zones de drop
    }

    var typeAction = document.getElementsByClassName('type_action');

    for (var i = 0; i < typeAction.length; i++) {
        typeAction[i].addEventListener('click', function(){
            butSurAction(this);//Appel à la fonction ajoutant un but sur une action de jeu
        });
    }

    var typeBut = document.getElementsByClassName('type_but');

    for (var i = 0; i < typeBut.length; i++) {
        typeBut[i].addEventListener('click', function(){
            butSimple(this);//Appel à la fonction qui ajoute un but simple
        });
    }

    var typePasse = document.getElementsByClassName('type_passe');

    for (var i = 0; i < typePasse.length; i++) {
        typePasse[i].addEventListener('click', function(){
            passeDecisive(this);//Appel à la fonction qui ajoute une passe decisive et son type
        });
    }

    var actionSimple = document.getElementsByClassName('simple');

    for (var i = 0; i < actionSimple.length; i++) {
        actionSimple[i].addEventListener('click', function(){
            actionDansLeJeu(this);
        });
    }

})();