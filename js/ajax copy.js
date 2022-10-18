updateContentTable();
// add active class in selected list Item
let navList = document.querySelectorAll(".navigation ul li:not(:nth-child(1))");
let tables = document.querySelectorAll(".tables table");
let toolBarTitle = document.querySelector(".toolBar .title");
navList.forEach((item, index) => {
    item.addEventListener("click", (e) => {
        console.log("current table ",tables[index].classList);
        navList.forEach((it) => {
            it.classList.remove("active");
        });
        toolBarTitle.textContent = e.target.dataset.name;
        document.querySelector(".tables table.active").classList.remove("active");
        tables[index].classList.add("active");
        // clear local storag
        localStorage.removeItem("item_active");
        //Set navItem On Locale Storag
        localStorage.setItem("item_active", e.target.dataset.name);
        e.target.classList.add("active");
        document.querySelector(".textBox").value = "";
        // update content table
        updateContentTable();
        if (tables[index].classList.contains("enseignements") || tables[index].classList.contains("inscription_cours")) 
            document.querySelector('.modifierBes').style = "display: none;";
        else 
            document.querySelector('.modifierBes').style = "";
    });
});

//#add event click btnToggle
let btnToggleNav = document.querySelector(".topbar .toggle");
btnToggleNav.addEventListener("click", () => {
    document.querySelector(".navigation").classList.toggle("active");
    document.querySelector(".main").classList.toggle("active");
    document.querySelector(".container").classList.toggle("active");
});



// add event click in btn supprimer
let btnSupprimerBes = document.querySelector(".supprimerBes");
btnSupprimerBes.addEventListener("click", () => {
    let trSeleced = document.querySelector("table.active tbody tr.selectedRow ");
    if (trSeleced != null) {
        let tableName = document.querySelector("table.active").dataset.table;
        let idName = document.querySelector(
            "table.active thead tr td:nth-child(2)"
        ).textContent;
        let idValue = trSeleced.children[1].textContent;
        deleteElement(idValue, tableName, idName);
    }
});

// add event click in btn modifier
let btnModifierBes = document.querySelector(".modifierBes");
btnModifierBes.addEventListener("click", () => {
    let trSeleced = document.querySelector("table.active tbody tr.selectedRow ");
    if (trSeleced != null) {
        let tableName = document.querySelector("table.active").dataset.table;
        let idName = document.querySelector(
            "table.active thead tr td:nth-child(2)"
        ).textContent;
        let idValue = trSeleced.children[1].textContent;
        modifier(idValue, tableName, idName);
    }
});

// add event click of btn next / prev
let next = document.querySelector(".next");
let prev = document.querySelector(".prev");
let i = 0;
next.addEventListener("click", (e) => {
    let row = document.querySelectorAll("table.active tr");

    if (i < row.length - 1) {
        row[i].classList.remove("selectedRow");
        row[i + 1].classList.add("selectedRow");
        i++;
    } else {
        row[i].classList.remove("selectedRow");
        i = 0;
    }
});
prev.addEventListener("click", (e) => {
    let row = document.querySelectorAll("table.active  tr");
    console.log(row);
    if (i > 0) {
        row[i].classList.remove("selectedRow");
        row[i - 1].classList.add("selectedRow");
        i--;
    } else {
        i = row.length - 1;
        row[i].classList.add("selectedRow");
    }
});

// check item active in
let itemActive = localStorage.getItem("item_active");
if (itemActive !== null) {
    navList.forEach((item, index) => {
        if (item.dataset.name == itemActive) {
            toolBarTitle.textContent = item.dataset.name;
            document
                .querySelector(".navigation ul li.active")
                .classList.remove("active");
            item.classList.add("active");
            document.querySelector(".tables table.active").classList.remove("active");
            tables[index].classList.add("active");
        }
    });
}

// check recherch is  active
let recherchActive = localStorage["recherchActive"];
if (recherchActive != null) {
    document.querySelector(".besoin .dropDown").style.display = "block";
    document.querySelector(".besoin .search").classList.add("active");
    document.querySelector(".search .icon ").classList.add("active");
    document.querySelector(".cancel-icon").classList.add("active");
}

// add event click in btn ajouter
let btnAjouter = document.querySelector(".besoin .ajouterBes ");
let overlay = document.querySelector("#over")
btnAjouter.addEventListener("click", () => {
    // dataJson();
    overlay.classList.add('overlay')
    setTimeout(() => {
        if (navList[0].classList.contains("active")) {
            document.querySelector(".ajouter.Etudiant").classList.add("active");
        }
        if (navList[1].classList.contains("active")) {
            document.querySelector(".ajouter.Enseignant").classList.add("active");
        }
        if (navList[2].classList.contains("active")) {
            document.querySelector(".ajouter.Cour").classList.add("active");
        }
        if (navList[3].classList.contains("active")) {
            document.querySelector(".ajouter.enseignements").classList.add("active");
        }
        if (navList[4].classList.contains("active")) {
            document.querySelector(".ajouter.inscription_cours").classList.add("active");
        }
    }, 500)
});

// add event click in btnClose
let btnClose = document.querySelectorAll(".btnClose");
btnClose.forEach((btn) => {
    btn.addEventListener("click", function (e) {
        // e.currentTarget.parentElement.classList.remove("active");
        e.currentTarget.parentElement.classList.remove("active");
        overlay.classList.remove("overlay");
    });
});

// add event click ajouterElement
let btnajouterElement = document.querySelectorAll(".ajouterElement");
btnajouterElement.forEach((ajouter) => {
    ajouter.onclick = insertMemberInfo;
});

// add event click in btn modifierElement
let btnmodifierElement = document.querySelectorAll(".modifierElement");
btnmodifierElement.forEach((modifier) => {
    modifier.onclick = modifierElements;
});

// select btn rechercher element
let btnRechercherElement = document.querySelector(".rechercheElement");
btnRechercherElement.onclick = rechercheElement;

// dropDown select
let dropDown = document.querySelector(".besoin .dropDown");
dropDown.onclick = function () {
    chargerOption();
    document.querySelector(".dropDown .option").classList.toggle("active");
    this.classList.toggle("active");
};

// search
let search_box = document.querySelector(".besoin .search");
let search_icon = document.querySelector(".search .icon ");
let cancel_icon = document.querySelector(".cancel-icon");
let inpsearch = document.querySelector(".besoin .search .input-search");
search_icon.onclick = () => {
    search_box.classList.add("active");
    search_icon.classList.add("active");
    cancel_icon.classList.add("active");
    inpsearch.focus();
    dropDown.style.display = "block";
    localStorage.setItem("recherchActive", "active");
};
cancel_icon.addEventListener("click", (e) => {
    search_box.classList.remove("active");
    search_icon.classList.remove("active");
    cancel_icon.classList.remove("active");
    dropDown.style.display = "none";
    inpsearch.value = "";
    localStorage.removeItem("recherchActive");
    updateContentTable();
});
let searchInput = document.querySelector(".search .input-search");
console.log(searchInput);
searchInput.onkeyup = function (e) {
    if (e.key == "Enter") {
        rechercheElement();
    }
    if (this.value == '') {
        console.log('empty');
        updateContentTable()
    }


};
// function charger option element
function chargerOption() {
    let thead = Array.from(document.querySelectorAll("table.active thead td"));
    let opName = thead.map((e) => e.textContent).filter((el) => el != "");
    let divOption = document.querySelector(".besoin .dropDown .option");
    divOption.innerHTML = "";
    // document.querySelector(".textBox").value = "";
    opName.forEach((item) => {
        if(item != "Type") {
            let divItem = document.createElement("div");
            divItem.textContent = item;
            divOption.appendChild(divItem);
        }
    });
    let options = document.querySelectorAll(".besoin .dropDown .option div");
    options.forEach((option) => {
        option.addEventListener("click", function (e) {
            document.querySelector(".textBox").value = e.target.textContent;
            searchInput.focus()
        });
    });
}

// delete Element
function deleteElement(idValue, tableName, idName) {
    let suppBox = document.querySelector(".supprimerElement");
    let btnSuppOui = document.querySelector(".supprimerElement .choice .oui");
    suppBox.style.display = "flex";
    overlay.classList.add("overlay");
    suppBox.lastElementChild.addEventListener("click", (even) => {
        if (even.target.textContent == "Non") {
            suppBox.style.display = "none";
            overlay.classList.remove("overlay");
        } else if (even.target.textContent == "Oui") {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    updateContentTable();
                }
            };
            xhr.open(
                "GET",
                `delete.php?id_num=${idValue}&table_name=${tableName}&id_name=${idName}`,
                true
            );
            xhr.send();
            suppBox.style.display = "none";
            overlay.classList.remove("overlay");
        }
    });
}

// function delete
function deleteEns(idValueEns, idValueCour, tableName, idNameEns, idNameCour, typeEnseignement) {
    console.log(idNameEns);
    console.log({ idNameEns: idValueEns, idNameCour: idValueCour, tableName });
    let suppBox = document.querySelector(".supprimerElement");
    let btnSuppOui = document.querySelector(".supprimerElement .choice .oui");
    suppBox.style.display = "flex";
    overlay.classList.add("overlay");
    suppBox.lastElementChild.addEventListener("click", (even) => {
        if (even.target.textContent == "Non") {
            suppBox.style.display = "none";
            overlay.classList.remove("overlay");
        } else if (even.target.textContent == "Oui") {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    updateContentTable();
                }
            };
            xhr.open(
                "GET",
                `delete.php?ID_Enseignant=${idValueEns}&ID_Cours=${idValueCour}&table_name=${tableName}&id_name_ens=${idNameEns}&id_name_cour=${idNameCour}`,
                true
            );
            xhr.send();
            suppBox.style.display = "none";
            overlay.classList.remove("overlay");
        }
    });
}

// update Table Contelont
function updateContentTable() {
    setTimeout(function () {
        let tableSeleced = document.querySelector("table.active").dataset.table;
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector("table.active #content").innerHTML =
                    this.responseText;
            }
            countRowTables();
        };
        xhr.open("GET", `UpdateTable.php?tableUpdate=${tableSeleced}`, true);
        xhr.send();
    }, 100);
}

// insert Member  Information
function insertMemberInfo() {
    setTimeout(() => {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(JSON.parse(this.responseText));
                updateContentTable();
            }
        };
        xhr.open("POST", "insert.php", true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlenooded");
        let formData = document.querySelector(".ajouter.active #formData");
        let data = new FormData(formData);
        xhr.send(data);
        document.querySelector(".ajouter.active").classList.remove("active");
        overlay.classList.remove("overlay");
        console.log(data);
    }, 100);
    return false;
}

// check modifier Element
function modifier(idValue, tableName, idName) {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let jsonObject = JSON.parse(this.responseText);
            console.log(jsonObject);
            chrgreInfoModifier(jsonObject, tableName);
        }
    };
    xhr.open(
        "GET",
        `infoElementModifier.php?id_Modifier=${idValue}&table_Modifier=${tableName}&id_Name_Modifier=${idName}`,
        true
    );
    xhr.send();
    setTimeout(() => {
        let modifierActive = document.querySelector("table.active").dataset.table;
        switch (modifierActive) {
            case "etudiants":
                document.querySelector(".modifier.Etudiant").classList.add("active");
                overlay.classList.add("overlay");
                break;
            case "enseignants":
                document.querySelector(".modifier.Enseignant").classList.add("active");
                overlay.classList.add("overlay");
                break;
            case "cours":
                document.querySelector(".modifier.cour").classList.add("active");
                overlay.classList.add("overlay");
                break;
            default:
                break;
        }
    }, 100);
}
// chargrer info element modifier
function chrgreInfoModifier(js, boxName) {
    if (boxName == "cours") {
        document.querySelector('.modifier.cour input[name="ID_Cours"]').value =
            js["ID_Cours"];
        document.querySelector('.modifier.cour input[name="Nom"]').value =
            js["Nom"];
        document.querySelector('.modifier.cour input[name="Coeffecient"]').value =
            js["Coeffecient"];
    } else if (boxName == "enseignants") {
        document.querySelector('.modifier.Enseignant input[name="ID_Enseignant"]').value =
            js["ID_Enseignant"];
        document.querySelector(
            '.modifier.Enseignant input[name="Nom"]'
        ).value = js["Nom"];
        document.querySelector(
            '.modifier.Enseignant input[name="Prenom"]'
        ).value = js["Prenom"];
        document.querySelector(
            '.modifier.Enseignant input[name="N_Tel"]'
        ).value = js["N_Tel"];
        document.querySelector(
            '.modifier.Enseignant input[name="Email"]'
        ).value = js["Email"];
        document.querySelector(".modifier.Enseignant textarea").textContent =
            js["Adresse"];
    } else {
        document.querySelector('.modifier.Etudiant input[name="ID_Etudiant"]').value =
            js["ID_Etudiant"];
        document.querySelector('.modifier.Etudiant input[name="Nom"]').value =
            js["Nom"];
        document.querySelector(
            '.modifier.Etudiant input[name="Prenom"]'
        ).value = js["Prenom"];
        document.querySelector('.modifier.Etudiant input[name="N_Tel"]').value =
            js["N_Tel"];
        document.querySelector(
            '.modifier.Etudiant input[name="Email"]'
        ).value = js["Email"];
        document.querySelector('.modifier.Etudiant input[name="Specialite"]').value =
            js["Specialite"];
        document.querySelector(".modifier.Etudiant textarea").textContent =
            js["Adresse"];
    }
}
// modifiee element
function modifierElements() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "modifierElement.php", true);
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlenooded");
    let formData = document.querySelector(".modifier.active #formData");
    let data = new FormData(formData);
    xhr.send(data);
    document.querySelector(".modifier.active").classList.remove("active");
    overlay.classList.remove("overlay");
    setTimeout(() => {
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                updateContentTable();
            }
        };
    }, 100);
    return false;
}

// rechercher Element
function rechercheElement() {
    // select info recherch
    let searchElement = document.querySelector(".textBox").value;
    let searchTable = document.querySelector("table.active").dataset.table;
    let searchValue = document.querySelector(".search .input-search").value;
    setTimeout(() => {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector("table.active #content").innerHTML =
                    this.responseText;
            }
        };
        xhr.open(
            "GET",
            `recherche.php?searchTable=${searchTable}&searchElement=${searchElement}&searchValue=${searchValue}`,
            true
        );
        xhr.send();
    }, 100);

    return false;
}

// function countRow Tables
function countRowTables() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            let jsonData = JSON.parse(this.responseText);
            // set Count Element
            document.querySelector(".info .infoEtudiant .numbers").textContent =
                jsonData["CountEtudian"];
            document.querySelector(".info .infoEnseignant .numbers").textContent =
                jsonData["CountEnseignant"];
            document.querySelector(".info .infoCour .numbers").textContent =
                jsonData["CountCour"];
        }
    };
    xhr.open("GET", `countTable.php`, true);
    xhr.send();
}

// // function Box (ajouter/modifier) element
// function createForm(dataInput, NameTable) {
//     let dataName = dataInput.filter((e) => typeof(e) == "string")
//     let parentElement = document.createElement('div');
//     let parentName = NameTable;
//     console.log(parentName);
//     parentElement.className = 'ajouter';
//     parentElement.classList.add(parentName);


//     // create btn close
//     let spanClose = document.createElement('span');
//     spanClose.className = 'btnClose';
//     spanClose.innerHTML = 'x'
//     parentElement.appendChild(spanClose)

//     // create main heading
//     let mainHeading = document.querySelector('div');
//     mainHeading.className = 'main-heading';
//     mainHeading.innerHTML = `<h2>Ajouter <span>${parentName}</span></h2>`
//     parentElement.appendChild(mainHeading)

//     // create form
//     let mainForm = document.createElement('form');
//     mainForm.id = 'formData';
//     mainForm.autocomplete = 'off'


//     // create left and right div Element
//     let left = document.createElement('div');
//     left.classList.add('left');
//     let right = document.createElement('div');
//     right.classList.add('right');

//     // fill input element to left and right element
//     let tableName = document.querySelector('table.active').dataset.table;
//     let inputTableName = document.createElement('input');
//     inputTableName.setAttribute("type", 'text');
//     inputTableName.setAttribute('name', 'tableName');
//     inputTableName.setAttribute('value', tableName);
//     left.appendChild(inputTableName);
//     inputTableName.style.display = 'none'

//     dataName.forEach((data) => {
//         let inputFeild
//         if (data == 'Adresse') {
//             inputFeild = document.createElement('textarea');
//         } else {
//             inputFeild = document.createElement('input')
//         }

//         if (data == 'Email') {
//             inputFeild.setAttribute('type', 'email')
//         } else if (data == 'N_Tel') {
//             inputFeild.setAttribute('type', 'tel')
//         } else {
//             inputFeild.setAttribute('type', 'text')
//         }
//         inputFeild.setAttribute('name', data)
//         inputFeild.setAttribute('placeholder', data)
//         if (data != 'Adresse') {
//             left.appendChild(inputFeild)
//         } else {
//             right.appendChild(inputFeild)
//         }
//         inputFeild.required;
//     })

//     // create btn rest and valider
//     let btnSub = document.createElement('div')
//     btnSub.className = 'btn_submit';
//     let btnvalider = document.createElement('button');
//     btnvalider.className = 'ajouterElement';
//     btnvalider.textContent = 'Ajouter';
//     let btnrest = document.createElement('button');
//     btnrest.setAttribute('type', 'rest');
//     btnrest.textContent = 'Supprimer'
//     btnSub.appendChild(btnvalider)
//     btnSub.appendChild(btnrest)
//     right.appendChild(btnSub)

//     // append left and right element in mainFrom element
//     mainForm.appendChild(left);
//     mainForm.appendChild(right);

//     // append main form in parent Element
//     parentElement.appendChild(mainForm);

//     // append parentElement to main body
//     document.body.appendChild(parentElement)
// }

// // get feilds
// let dataJson = () => {
//     let tableSelected = (document.querySelector('.navigation li.active .icon ').dataset.name).toLowerCase();

//     let xhr = new XMLHttpRequest();
//     xhr.open('GET', `selectAttr.php?tableSelected=${tableSelected}`, true)
//     xhr.send();
//     xhr.onreadystatechange = function() {
//         if (this.status = 200 && this.readyState == 4) {
//             var js = JSON.parse(this.responseText);
//             let tableName = document.querySelector('table.active').getAttribute('title');
//             setTimeout(() => {
//                 createForm(js, tableName)
//             }, 100)

//         }

//     }
// }