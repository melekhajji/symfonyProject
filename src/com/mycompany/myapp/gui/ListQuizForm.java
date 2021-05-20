/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.components.SpanLabel;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.myapp.entities.Quiz;
import com.mycompany.myapp.services.ServiceQuiz;
import java.io.IOException;
import java.util.ArrayList;

/**
 *
 * @author bhk
 */


   public class ListQuizForm extends Form{
       
  public  ListQuizForm(Form previous) {

      
       setTitle("List Quiz");
         
   
 
        
      
        ServiceQuiz es = new ServiceQuiz();
        ArrayList<Quiz> list = es.getAllQuizs();

        {
           
            for (Quiz r : list) {

          
 
                Container c3 = new Container(BoxLayout.y());
               
                 SpanLabel cat= new SpanLabel("Thème :" + r.getTheme());
                 SpanLabel cat1= new SpanLabel("Durée :" + r.getDuree());
                 SpanLabel cat2= new SpanLabel("Nombre de questions :" + r.getNbquestion());

               
                     
                      
                        c3.add(cat);
           c3.add(cat1);
               c3.add(cat2);
                      
                           
         Button Delete =new Button("Delete","LoginButton");
         c3.add(Delete);
            Delete.getAllStyles().setBgColor(0xF36B08);
            Delete.addActionListener(e -> {
               Dialog alert = new Dialog("Warning");
                SpanLabel message = new SpanLabel("Are you sure you want to delete your quiz!");
                alert.add(message);
                Button ok = new Button("Yes");
                Button cancel = new Button(new Command("No"));
                //User clicks on ok to delete account
                ok.addActionListener(new ActionListener() {
                  
                    public void actionPerformed(ActionEvent evt) {
                       es.Delete(r.getId());
                     
                        alert.dispose();
                        refreshTheme();
                    }
                    
                }
                
                
                );

                alert.add(cancel);
                alert.add(ok);
                alert.showDialog();
                
                      
                            new ListQuizForm(previous).show();
                              getContentPane().animateLayout(150);
                        
                
             
            });
                                
           System.out.println("");
              
  add(c3);
              
            
          getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK
                , e-> previous.showBack()); // Revenir vers l'interface précédente
                
            }
          
        }
     
    }
   }