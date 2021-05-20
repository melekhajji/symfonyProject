/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.components.SpanLabel;
import com.codename1.ui.Container;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.myapp.entites.Offre;
import com.mycompany.myapp.services.ServiceOffre;
import java.io.IOException;
import java.util.ArrayList;

/**
 *
 * @author bhk
 */


   public class ListOffre extends Form{
       
  public  ListOffre(Form previous) {

      
       setTitle("List Offre");
         
   
 
        
      
        ServiceOffre es = new ServiceOffre();
        ArrayList<Offre> list = es.getAllOffres();

        {
           
            for (Offre r : list) {

          
 
                Container c3 = new Container(BoxLayout.y());
               
                 SpanLabel cat= new SpanLabel("Titre :" + r.getTitre());
                 SpanLabel cat1= new SpanLabel("Entreprise :" + r.getEntreprise());
                 SpanLabel cat2= new SpanLabel("Adresse :" + r.getAdresse());
                 SpanLabel cat3= new SpanLabel("Postes_Vacants :" + r.getPostes_vacants());
                 SpanLabel cat4= new SpanLabel("Type_Contrat :" + r.getType_contrat());
                 SpanLabel cat5= new SpanLabel("Experience :" + r.getExperience());
                 SpanLabel cat6= new SpanLabel("Remuneration :" + r.getRemuneration());
                 SpanLabel cat7= new SpanLabel("Langues :" + r.getLangues());
                 SpanLabel cat8= new SpanLabel("Description :" + r.getDescription());
                 SpanLabel cat9= new SpanLabel("Date_expiration :" + r.getDate_expiration());

               
                     
                      
                        c3.add(cat);
           c3.add(cat1);
               c3.add(cat2);
                              c3.add(cat3);
                                             c3.add(cat4);
                                                            c3.add(cat5);
                                                                           c3.add(cat6);
                                                                                          c3.add(cat7);
                                                                                                         c3.add(cat8);
                                                                                                                        c3.add(cat9);







                      
                        
           System.out.println("");
              
  add(c3);
              
            
          getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK
                , e-> previous.showBack()); // Revenir vers l'interface précédente
                
            }
          
        }
     
    }
   }
    
    

