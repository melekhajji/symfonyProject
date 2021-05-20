/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.esprit.gui;

import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Container;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import tn.esprit.entities.User;
import tn.esprit.services.UserService;

/**
 *
 * @author rayen
 */
public class UpdatePatientMyProfil extends Form{
    public UpdatePatientMyProfil(Resources theme, User user) {
        setTitle("modifier mon profil");
        Label username = new Label("username");
        TextField txt_username = new TextField(user.getUsername());
        Label label_roles = new Label("role");
        ComboBox roles = new ComboBox("Admin", "Recruteur", "Candidat");
        if (user.getRoles().contains("Admin")) {
        roles.setSelectedItem("Admin");
        } else if (user.getRoles().contains("Recruteur")) {
            roles.setSelectedItem("Recruteur");
        } else if (user.getRoles().contains("Candidat")) {
            roles.setSelectedItem("Candidat");
        }
         getToolbar().addCommandToRightBar("retour", null, (ev)->{new HomePatientForm(theme,user).show();
          });
        Label label_cin = new Label("CIN");
        TextField txt_cin = new TextField(String.valueOf(user.getCin()));
        Label label_email = new Label("email");
        TextField txt_email = new TextField(user.getEmail());
        Button button_update = new Button("modifier");
                Container cnt = BoxLayout.encloseY(username, BorderLayout.center(txt_username),label_roles, BorderLayout.center(roles),label_cin,
                         BorderLayout.center(txt_cin),label_email, BorderLayout.center(txt_email),button_update);

        button_update.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
               user.setUsername(txt_username.getText());
               user.setRoles(roles.getSelectedItem().toString());
               user.setEmail(txt_email.getText());
               user.setCin(Integer.parseInt(txt_cin.getText()));
                UserService userService = new UserService();
                userService.updateUser(user);
                if(user.getRoles().contains("Candidat")){
                    new HomePatientForm(theme,user).show();
                }
                else {
                    new HomeForm(theme, user).show();
                }
                
            }
        });
        add(cnt);

    }

}
