function ongletConditionsAchat(ongletCA){
var champs = ongletCA.champs;
var demande = ongletCA.demande;
var affichageChamps = ongletCA.affichageChamps;
var numUL = Number(affichageChamps.numUlPmd);
var numCA = Number(affichageChamps.numCondHa);
var wulgpreList = affichageChamps.wulgpre;
var wconpreList = affichageChamps.wconpre;
var AjoutCA = false;
var storeOuiNon = Ext.create('Prototype.store.OuiNon'); 
storeOuiNon.load();
var storeNUMUL = Ext.create('Prototype.store.NumUlCA'); 
storeNUMUL.load();
Ext.Array.each(affichageChamps.wulgpre,function(field, index, recordItSelf) {
storeNUMUL.insert(index,{libelle: field.ca_NUMUL_wulgpre, code: Number(field.ca_NUMUL_wulgpre)});
});

var storeNUMCA = Ext.create('Prototype.store.NumCaRef'); 
storeNUMCA.load();
Ext.Array.each(affichageChamps.wconpre,function(field, index, recordItSelf) {
storeNUMCA.insert(index,{libelle: field.ca_NUMCA_wconpre, code: Number(field.ca_NUMCA_wconpre)});
});
var storeNATPCB = Ext.create('Prototype.store.NATPCB'); 
storeNATPCB.load();
var storeDISPO = Ext.create('Prototype.store.DISPO'); 
storeDISPO.load();
var storeUNIEPX = Ext.create('Prototype.store.UNIEPX'); 
storeUNIEPX.load();
var storeINDINTER = Ext.create('Prototype.store.INDINTER'); 
storeINDINTER.load();
var storeEXPRIX = Ext.create('Prototype.store.EXPRIX'); 
storeEXPRIX.load();
var storeEXDELCF = Ext.create('Prototype.store.EXDECLF'); 
storeEXDELCF.load();
// var storeREGROUP = Ext.create('Prototype.store.Regroupement'); 
// storeREGROUP.load();
var storeINCOTERM = Ext.create('Prototype.store.Incoterm'); 
storeINCOTERM.load();
var storeINDVALO = Ext.create('Prototype.store.INDVALO'); 
storeINDVALO.load();
var storeINDFRCO = Ext.create('Prototype.store.INDFRCO'); 
storeINDFRCO.load();

var comboNumUL = creationComboboxAvecIndicateurAjoutChampVide(champs['ca_NUMUL'],storeNUMUL,'code','libelle',0.25,false);
comboNumUL.select(comboNumUL.getStore().first());
// Ext.getCmp(champs['ca_NUMUL'].codeTechnique).addListener(
// 'change', function(component, newValueUL, oldValueUL, eOpts) {
// var myMask = new Ext.LoadMask(Ext.getBody(), {
// msg : msgs.chargement.en.cours
// });
// myMask.show();
// Ext.Ajax.request({
//     
url: './ongletCA.aspx',
//     
params:{
//     
'numPreref' : demande.numPreRef,
//    
'idDemande' : demande.idDemande,
//    
'source' : '',
//    
'numUlpmd' : newValueUL,
//    
'numCondha': 0
//     
},
//     
success : function(response, action) {
//     
myMask.hide();
//     
var onglet = Ext.decode(response.responseText);
//    
var resultControle = onglet.resultControle;
//    
if (resultControle != undefined) {
//    
affichageErreur(resultControle);
//    
} else if(onglet.affichageChamps != undefined){
//    
//    
var newAffichageChamps = onglet.affichageChamps;
//    
//    
var form = Ext.getCmp('ongletConditionsAchatPanel').getForm();
//    
//    
if(wconpreList.length>newValueCA){
//    
var modelWCONPRE = Ext.create('Prototype.model.OngletCaWCONPRE',wconpreList[newValueCA-1]);
//    
form.setValues(modelWCONPRE.data);
//    
} 
//    
// if(newAffichageChamps.wcndprd.length>0){
// var modelWCNDPRD = Ext.create('Prototype.model.OngletCaWCNDPRD',newAffichageChamps.wcndprd[0]);
// form.setValues(modelWCNDPRD.data);
// }
// 
//    
prixCAArray = [];
//    
Ext.Array.each(newAffichageChamps.wpriprd,function(field, index, recordItSelf) {
//    
prixCAArray.push(Ext.create('Prototype.model.OngletCaWPRIPRD',field));
//    
});
//    
Ext.getCmp('grid-prixConditionsAchat').getStore().loadRecords(prixCAArray,false);
//    
}
//     
}
// });
// }
// );
var toolbarUL = Ext.create('Ext.toolbar.Toolbar', {
renderTo: Ext.getBody(),
   flex : 0.6,
   id: 'toolbarULId',
   items: [
       {
           text: '<<'
       },
       {
           
           text : '<'
       },
       {
           text : '>'
       },
       {
           text : '>>'
       }
   ]
});
var b1l0 = creationFieldContainer(
toolbarUL
);
var b1l1 = creationFieldContainer(
comboNumUL,
creationTextField(champs['ca_LIBELUL'],0.25),
creationDateField(champs['ca_DTDISUL'],0.25),
createSpacerFlex(1,1,0.25)
);
var b1l2 = creationFieldContainer(
creationCombobox(champs['ca_DISPOUL'],storeDISPO,'code','libelle',0.25),
creationTextField(champs['ca_CDGEST'],0.25),
creationDateField(champs['ca_DTDEREF'],0.25),
createSpacerFlex(1,1,0.25)
);
var b1l3 = creationFieldContainer(
creationCombobox(champs['ca_NATPCB'],storeNATPCB,'code','libelle',0.25),
creationCombobox(champs['ca_EXPRIX'],storeEXPRIX,'code','libelle',0.25),
creationTextField(champs['ca_PCB'],0.25),
createSpacerFlex(1,1,0.25)
);
var block1 = creationFieldSet('Groupe Logistique',b1l0,b1l1,b1l2,b1l3);
var comboNumCA= creationComboboxAvecIndicateurAjoutChampVide(champs['ca_NUMCA'],storeNUMCA,'code','libelle',0.25,false);
comboNumCA.select(comboNumCA.getStore().first());
Ext.getCmp(champs['ca_NUMCA'].codeTechnique).addListener(
'change', function(component, newValueCA, oldValueCA, eOpts) {
var form = Ext.getCmp('ongletConditionsAchatPanel').getForm();
if(wconpreList.length > newValueCA){
var myMask = new Ext.LoadMask(Ext.getBody(), {
msg : msgs.chargement.en.cours
});
myMask.show();
Ext.Ajax.request({
    
url: './ongletCA.aspx',
    
params:{
    
'numPreref' : demande.numPreRef,
   
'idDemande' : demande.idDemande,
   
'source' : '',
   
'numUlpmd' : numUL,
   
'numCondha': newValueCA
    
},
    
success : function(response, action) {
    
myMask.hide();
    
var onglet = Ext.decode(response.responseText);
   
var resultControle = onglet.resultControle;
   
if (resultControle != undefined) {
   
affichageErreur(resultControle);
   
} else if(onglet.affichageChamps != undefined){
   
var newAffichageChamps = onglet.affichageChamps;
   
numCA = newValueCA;
   
   
if(wconpreList.length>numCA){
   
var modelWCONPRE = Ext.create('Prototype.model.OngletCaWCONPRE',wconpreList[numCA-1]);
   
form.setValues(modelWCONPRE.data);
   
} 
   
   
var valuesWCNDPRD = null;
if(newAffichageChamps.wcndprd.length>0){
valuesWCNDPRD = newAffichageChamps.wcndprd[0];
}
var modelWCNDPRD = Ext.create('Prototype.model.OngletCaWCNDPRD',valuesWCNDPRD);
form.setValues(modelWCNDPRD.data);
   
prixCAArray = [];
   
Ext.Array.each(newAffichageChamps.wpriprd,function(field, index, recordItSelf) {
   
prixCAArray.push(Ext.create('Prototype.model.OngletCaWPRIPRD',field));
   
});
   
Ext.getCmp('grid-prixConditionsAchat').getStore().loadRecords(prixCAArray,false);
   
}
    
}
});
}else{
form.setValues(Ext.create('Prototype.model.OngletCaWCNDPRD',null));
Ext.getCmp('grid-prixConditionsAchat').getStore().loadRecords([Ext.create('Prototype.model.OngletCaWPRIPRD',null)],false);
}
}
);
var toolbarCA = Ext.create('Ext.toolbar.Toolbar', {
renderTo: Ext.getBody(),
   flex : 0.25,
   id: 'toolbarCAId',
   items: [
       {
           text: '<<',
           id : 'firstCAValue',
           listeners : {
           
afterrender: function() {
           
firstValue = comboNumCA.getStore().first().data.code;
               
if(numCA <=firstValue || numCA == undefined ){
               
Ext.getCmp('firstCAValue').disable();
               
}
           
},
           
click: function() {
          //  comboNumCA.select(comboNumCA.getStore().first());
           }
           }
       },
       {
           
           text : '<',
           id : 'previousCA',
           listeners : {
           
afterrender: function() {
               
firstValue = comboNumCA.getStore().first().data.code;
               
if(numCA <=firstValue || numCA == undefined ){
               
Ext.getCmp('previousCA').disable();
               
}
           
},
           
click: function() {
               
//var currentValue = comboNumCA.getValue();
               //comboNumCA.select(currentValue-1);
           
}
       
           }
       },
       {
           text : '>',
           id : 'nextCA',
           listeners : {
           
afterrender: function() {
               
lastValue = comboNumCA.getStore().last().data.code;
               
if(numCA >= lastValue || numCA == undefined ){
               
Ext.getCmp('nextCA').disable();
               
}
           
},
           
click: function() {
               var currentValue = comboNumCA.getValue();
           
} 
           }
       },
       {
       
text : '>>',
       
id : 'lastCA',
           listeners : {
           
afterrender: function() {
               
lastValue = comboNumCA.getStore().last().data.code;
               
if(numCA >= lastValue || numCA == undefined ){
               
Ext.getCmp('lastCA').disable();
               
}
           
},
           
click: {
               element: 'el',
               fn: function() {                
               //comboNumCA.select(comboNumCA.getStore().last());
               }
           
}
       
           }
       },
       {
           text : '+',
           listeners : {
           
click: function() {
           
var nextValue;
if(comboNumCA.getStore().last()!= undefined){
nextValue = comboNumCA.getStore().last().data.code+1;
}else{
nextValue = 1;
};
                    
                    var model = Ext.create('Prototype.model.ReferentielList',{
                    code : nextValue,
                    libelle : nextValue
                    });
                    comboNumCA.getStore().add(model);
                    comboNumCA.select(comboNumCA.getStore().last()); //FIXME
                   
                    var modelWCNDPRD = Ext.create('Prototype.model.OngletCaWCNDPRD',null);
form.setValues(modelWCNDPRD.data);
prixCAArray =[];
prixCAArray.push(Ext.create('Prototype.model.OngletCaWPRIPRD',null));
Ext.getCmp('grid-prixConditionsAchat').getStore().loadRecords(prixCAArray,false);
    
   
   
Ext.getCmp('grid-taxesConditionsAchat').getStore().loadRecords([],false);
    
   
   
Ext.getCmp('grid-taxesDonneesGenerales').getStore().loadRecords([],false);

   
Ext.getCmp('grid-remisesConditionsAchats').getStore().loadRecords([],false);
               }
           }
       },
       {
           text : '-',
           listeners : {
       
click: function(){ 
               
var record = comboNumCA.findRecord(comboNumCA.valueField, comboNumCA.getValue());
               
if(record != null || record != undefined){
               
comboNumCA.getStore().remove(record);
               
}
               
comboNumCA.select(comboNumCA.getStore().first());
           }
       }
       }
   ]
});
var b2l0 = creationFieldContainer(
toolbarCA,
createSpacerFlex(1,1,0.25),
createSpacerFlex(1,1,0.25),
createSpacerFlex(1,1,0.25),
createSpacerFlex(1,1,0.1)
);
var b2l1 = creationFieldContainer(
comboNumCA,
creationCombobox(champs['ca_NAT'],storeINDINTER,'code','libelle',0.25),
creationCombobox(champs['ca_EXDELCF'],storeEXDELCF,'code','libelle',0.25),
creationDateField(champs['ca_DEREF'],0.25),
createSpacerFlex(1,1,0.1)
);
// var b2l2 = creationFieldContainer(
// creationCombobox(champs['ca_EXPRIX'],storeINDINTER,'code','libelle',0.1),
// creationCombobox(champs['ca_EXDELCF'],storeEXDELCF,'code','libelle',0.1),
// //creationTextField(champs['ca_DELCFT'],0.15),
// creationDateField(champs['ca_DEREF'],0.1),
// createSpacerFlex(1,1,0.1)
// );
var block2 = creationFieldSet('Donneées non Datées',b2l0, b2l1);
var b3l1 = creationFieldContainer(
creationDateField(champs['ca_DTAPPLI'],0.25),
creationTextField(champs['ca_TXTVA'],0.25),
creationTextField(champs['ca_DEVISE'],0.25),
creationCombobox(champs['ca_INDVALO'],storeINDVALO,'code','libelle',0.25),
createSpacerFlex(1,1,0.1)
);
var b3l2 = creationFieldContainer(
creationTextField(champs['ca_CDFRN'],0.25),
// {id:'btnAideFrs', xtype : 'button', iconCls : 'icon2_search', handler : function() {windowFournisseursConsult();}},
// createSpacer(75,10),
creationTextField(champs['ca_NBPNT1'],0.25),
//creationTextField(champs['ca_NBUVCPT'],0.25),
creationCombobox(champs['ca_INDFRCO'],storeINDFRCO,'code','libelle',0.25),
createSpacerFlex(1,1,0.25)
);
var b3l3 = creationFieldContainer(
creationTextField(champs['ca_REGROUP'],0.25),
creationCombobox(champs['ca_INCOTRM'],storeINCOTERM,'code','libelle',0.25),
//{id:'btnAideRegrp', xtype : 'button', iconCls : 'icon2_search', handler : function() {windowRegroupementsConsult();}},
//createSpacer(75,10),
creationTextField(champs['ca_COMMBAR'],0.25),
createSpacerFlex(1,1,0.25)
);
var block3 = creationFieldSet('Donneées Datées',b3l1,b3l2,b3l3);
var hiddenBlock4 = champs['ca_TABPRIX'].droit == 'C';
var readOnlyBlock4 = champs['ca_TABPRIX'].droit != 'O' && champs['ca_TABPRIX'].droit != 'E';
var block4 = creationFieldSet('Prix',Ext.create('Prototype.view.center.GridPrixConditionsAchat',{
champ: champs['ca_TABPRIX'], 
hidden : hiddenBlock4, 
readOnly : readOnlyBlock4
}));
// 
var hiddenBlock5 = champs['ca_TABTAXE'].droit == 'C';
var readOnlyBlock5 = champs['ca_TABTAXE'].droit != 'O' && champs['ca_TABTAXE'].droit != 'E';
var block5 = creationFieldSet('Taxes',Ext.create('Prototype.view.center.GridTaxesConditionsAchat',{
champ: champs['ca_TABTAXE'], 
numUlpmd : numUL,
numCondha : numCA,
readOnly : readOnlyBlock5,
hidden : hiddenBlock5,
recordDelete : []
}));
var hiddenBlock6 = champs['ca_TABRPP'].droit == 'C';
var readOnlyBlock6 = champs['ca_TABRPP'].droit != 'O' && champs['ca_TABRPP'].droit != 'E';
var block6 = creationFieldSet('RPP',Ext.create('Prototype.view.center.GridRemisesConditionsAchats',{ 
champ: champs['ca_TABRPP'], 
champDate: champs['ca_DEREF'], 
hidden : hiddenBlock6, 
readOnly : readOnlyBlock6
}));
var block56 = creationFieldSetH(block5, block6);
var block7 = creationFieldSet('Taxes Générales',Ext.create('Prototype.view.center.GridTaxesDonneesGenerales'));
var hIdDeDemande = Ext.create('Ext.form.field.Hidden',{
id : "idDeDemande",
name : "idDeDemande",
value : demande.idDemande
});
var hNumPreref = Ext.create('Ext.form.field.Hidden',{
id : "hNumPreref",
name : "numPreRef",
value : demande.numPreRef
});
var hCodeOnglet = Ext.create('Ext.form.field.Hidden',{
id : "codeOnglet",
name : "codeOnglet",
value : codeOngletCA
});
var centerItems = [block1,block2,block3,block4,block56,block7,hIdDeDemande,hNumPreref,hCodeOnglet];
var panelConditionsAchat = new Ext.form.Panel({
id : 'ongletConditionsAchatPanel',
xtype : 'panel',
autoScroll : true,
autoHeight: true,
margin:'0 10 0 0',
items : centerItems,
trackResetOnLoad : true,
listeners : {
validitychange : function ( component, valid, eOpts ) {
if (valid) {
if (Ext.getCmp('labelErreur') != undefined) {
Ext.getCmp('labelErreur').messagesErreursControleSurface = [];
}
cacherErreur ();
}
},
fieldvaliditychange : function ( component, The, isValid, eOpts ) {
if (!isValid) {
affichageErreur(The.id, The.activeErrors[0], 'CS');
} else {
if (Ext.getCmp('labelErreur') != undefined && Ext.getCmp('labelErreur').messagesErreursControleSurface[The.id] != undefined) {
delete Ext.getCmp('labelErreur').messagesErreursControleSurface[The.id];
}
}
},
fielderrorchange : function ( component, The, error, eOpts ) {
var indSuppr = false;
if (error == "" && Ext.getCmp('labelErreur') != undefined) {
for(var key in Ext.getCmp('labelErreur').messagesErreursProc) {
if(Ext.String.startsWith(The.id,key,true)){
delete Ext.getCmp('labelErreur').messagesErreursProc[key];
indSuppr = true;
break;
}
}
if (indSuppr) {
var size = 0;
   for (var key in Ext.getCmp('labelErreur').messagesErreursProc) 
   {
       size++;
   }
   for (var key in Ext.getCmp('labelErreur').messagesErreursControleSurface) 
   {
       size++;
   }
   if (size == 0) {
   
cacherErreur ();
   }
}
}
}
}
});
if(affichageChamps != undefined ) {
var form = panelConditionsAchat.getForm();
form.reset();
form.setValues([{id:'hNumPreref', value:affichageChamps .numpreref}]);
if(wulgpreList.length>0){
var modelWULGPRE = Ext.create('Prototype.model.OngletCaWULGPRE', wulgpreList[0]);
form.setValues(modelWULGPRE.data);
}
if(wconpreList.length>0){
var modelWCONPRE = Ext.create('Prototype.model.OngletCaWCONPRE',wconpreList[0]);
form.setValues(modelWCONPRE.data);
} 
if(affichageChamps.wcndprd.length>0){
var modelWCNDPRD = Ext.create('Prototype.model.OngletCaWCNDPRD',affichageChamps.wcndprd[0]);
form.setValues(modelWCNDPRD.data);
}
prixCAArray = [];
Ext.Array.each(affichageChamps.wpriprd,function(field, index, recordItSelf) {
prixCAArray.push(Ext.create('Prototype.model.OngletCaWPRIPRD',field));
});
Ext.getCmp('grid-prixConditionsAchat').getStore().loadRecords(prixCAArray,false);
//Gestion des taxes CA
taxesCAArray = [];
Ext.Array.each(champs.wtxcapr,function(field, index, recordItSelf) {
taxesCAArray.push(Ext.create('Prototype.model.OngletCaWTXCAPR',field));
});
Ext.getCmp('grid-taxesConditionsAchat').getStore().loadRecords(taxesCAArray,false);
//Gestion des taxes DG
taxesDGArray = [];
Ext.Array.each(champs.wtxrepr,function(field, index, recordItSelf) {
taxesDGArray.push(Ext.create('Prototype.model.OngletDgWTXREPR',field));
});
Ext.getCmp('grid-taxesDonneesGenerales').getStore().loadRecords(taxesDGArray,false);

remisesArray = [];
Ext.Array.each(affichageChamps.wrpppre,function(field, index, recordItSelf) {
remisesArray.push(Ext.create('Prototype.model.OngletCaWRPPPRE',field));
});
Ext.getCmp('grid-remisesConditionsAchats').getStore().loadRecords(remisesArray,false);
}
return panelConditionsAchat;
}

function affichageErreur (champErreur, messageErreur, origine) {
if (Ext.getCmp('labelErreur') == undefined) {
var labelErreur = {
id : 'labelErreur',
cls : 'label-error',
text : 'Le formulaire contient des erreurs (cliquer pour afficher les détails...)',
xtype : 'label',
name : 'ERR',
value : 'ERR',
messagesErreursProc : {},
messagesErreursControleSurface : {},
listeners : {
click : {
element : 'el',
fn : function() {
var msg = "";
for(var key in Ext.getCmp('labelErreur').messagesErreursProc) {
msg = Ext.String.insert(msg, "<br>" + Ext.getCmp('labelErreur').messagesErreursProc[key] + "<br>", 0);
}
for(var key in Ext.getCmp('labelErreur').messagesErreursControleSurface) {
msg = Ext.String.insert(msg, "<br>" + Ext.getCmp('labelErreur').messagesErreursControleSurface[key] + "<br>", 0);
}
Ext.Msg.alert('Erreurs', msg);
}
}
}
};
Ext.getCmp('actionsOngletToolBar').insert(0,labelErreur);
}
if (origine == 'PROC') {
Ext.getCmp('labelErreur').messagesErreursProc[champErreur] = messageErreur;
} else {
Ext.getCmp('labelErreur').messagesErreursControleSurface[champErreur] = messageErreur;
}
}