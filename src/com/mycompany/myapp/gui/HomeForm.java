/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.ui.Form;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.Label;
import com.codename1.ui.Button;

/**
 *
 * @author ASUS
 */
public class HomeForm extends Form{
    Form current;
    public HomeForm() {
        current=this;
        setTitle("Home");
        setLayout(BoxLayout.y());
        
        add(new Label("Choose an option"));
        Button btnAddOffre = new Button("Add Offre");
        Button btnListOffre = new Button("list Offre");
        
        btnAddOffre.addActionListener(e->new AddOffre(current).show());
        btnListOffre.addActionListener(e->new ListOffre(current).show());
        addAll(btnAddOffre,btnListOffre);
        
        
    }
    
}
