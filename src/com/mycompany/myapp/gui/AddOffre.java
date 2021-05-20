/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;


import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.myapp.entites.Offre;
import com.mycompany.myapp.services.ServiceOffre;


/**
 *
 * @author ASUS
 */
public class AddOffre extends Form {
    
    public AddOffre(Form previous){
        setTitle("Add new offre");
        setLayout(BoxLayout.y());
        
        TextField tfTitre = new TextField("","Titre");
        TextField tfEntreprise= new TextField("", "Entreprise");
        TextField tfAdresse= new TextField("", "Adresse");
        TextField tfPostesVacants= new TextField("", "Postes_Vacants");
        TextField tfTypeContrat= new TextField("", "Type_Contrat");
        TextField tfExperience= new TextField("", "Experience");
        TextField tfRemuneration= new TextField("", "Remuneration");
        TextField tfLangue= new TextField("", "Langue");
        TextField tfDescription= new TextField("", "Description");
        TextField tfDate= new TextField("","Date");
        
        
        
        
        Button btnValider = new Button("Add offre");
        
        btnValider.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent evt){
                if ((tfTitre.getText().length()==0)||(tfEntreprise.getText().length()==0)||(tfAdresse.getText().length()==0)||(tfPostesVacants.getText().length()==0)||(tfTypeContrat.getText().length()==0)||(tfExperience.getText().length()==0)||(tfRemuneration.getText().length()==0)||(tfLangue.getText().length()==0)||(tfDescription.getText().length()==0))
                    Dialog.show("Alert", "Please fill all the fields", new Command("OK"));
                 else
                {
                    try {
                        Offre o = new Offre(tfTitre.getText(),tfEntreprise.getText(),tfAdresse.getText(),tfPostesVacants.getText(),tfTypeContrat.getText(),tfExperience.getText(),tfRemuneration.getText(),tfLangue.getText(),tfDescription.getText(),tfDate.getText());
                        if( ServiceOffre.getInstance().addO(o))
                            Dialog.show("Success","Connection accepted",new Command("OK"));
                        else
                            Dialog.show("ERROR", "Server error", new Command("OK"));
                    } catch (NumberFormatException e) {
                        Dialog.show("ERROR", "error", new Command("OK"));
                    }
                    
                }
            }
        });
        
        
        addAll(tfTitre,tfEntreprise,tfAdresse,tfPostesVacants,tfTypeContrat,tfExperience,tfRemuneration,tfLangue,tfDescription,tfDate,btnValider);
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK
                , e-> previous.showBack());
    }
    
}
