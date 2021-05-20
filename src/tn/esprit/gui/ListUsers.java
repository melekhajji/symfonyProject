/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.esprit.gui;

import com.codename1.components.ImageViewer;
import com.codename1.components.MultiButton;
import com.codename1.components.ToastBar;
import com.codename1.ui.Button;
import com.codename1.ui.Component;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Image;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import tn.esprit.entities.User;
import tn.esprit.services.UserService;

/**
 *
 * @author rayen
 */
public class ListUsers extends Form {
       public static ArrayList<User>  listUsers = new ArrayList<>();
 public static UserService userService=new UserService();
 Container ctn, ctn1;
 Form f;
    public ListUsers(Resources theme,User user) {
        setTitle("Liste des utilisateurs");
        getAllStyles().setBgColor(0xfff2e6);
        ctn = new Container(BoxLayout.y());
        ctn1 = new Container(BoxLayout.y());
        ctn.setScrollableY(true);
          ctn1.setScrollableY(true);
          TextField filter = new TextField();
           Button pdf=new Button("pdf");
      add(pdf);  
      pdf.addActionListener(new ActionListener() {
                  
                    public void actionPerformed(ActionEvent evt) {
                        String path="";
        
        Document document = new Document();
      try
      {
         PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(path+"user.pdf"));
           document.open();
          PdfPTable tb1 = new PdfPTable(3);
          tb1.addCell("Email");
          tb1.addCell("Username");
          tb1.addCell("Cin");
          
         UserService es = new UserService();
        ArrayList<User> list = es.getAll();
          for (int i = 0; i < list.size(); i++) {
            
              String theme= String.valueOf(list.get(i).getEmail());
              String duree= String.valueOf(list.get(i).getUsername());
              String nbquestion= String.valueOf(list.get(i).getCin());
              
              
          tb1.addCell(theme);
          tb1.addCell(duree);
          tb1.addCell(nbquestion);
         
         
          }
         document.add(new Paragraph("user"));
         document.add(tb1);
         document.close();
         writer.close();
        com.codename1.io.File file=new com.codename1.io.File("user.pdf");
        //desktop.open(file);
      } catch (DocumentException e)
      {
         e.printStackTrace();
      }catch (FileNotFoundException e)
      {
         e.printStackTrace();
      }
                        //Logger.getLogger(ListFormation.class.getName()).log(Level.SEVERE, null, ex);

                     
                    }
                    
                }
                
                
                ); 
        Image icon = FontImage.createMaterial(FontImage.MATERIAL_CAMERA_ALT, UIManager.getInstance().getComponentStyle("Label"));
        Button cam = new Button(icon);
        add(cam); 
        //add an ActionListener to the cam Button
        cam.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent evt) {
                
                //This will trigger the native camera to display
                com.codename1.capture.Capture.capturePhoto(new ActionListener() {

                    public void actionPerformed(final ActionEvent evt) {
                        //if a user cancels the camera the evt will be null
                        if (evt == null) {
                            ToastBar.Status s = ToastBar.getInstance().createStatus();
                            s.setMessage("User Cancelled Camera");
                            s.setMessageUIID("Title");
                            Image i = FontImage.createMaterial(FontImage.MATERIAL_ERROR, UIManager.getInstance().getComponentStyle("Title"));
                            s.setIcon(i);
                            s.setExpires(2000);
                            s.show();
                            return;
                        }
                        //Create a component to display from the image path
                        Component imageCmp = createImageComponent((String) evt.getSource());
                        addComponent(BorderLayout.CENTER, imageCmp);
                        revalidate();

                    }

                    private Component createImageComponent(String path) {
        InputStream is = null;
        try {
            System.out.println("path " + path);
            is = com.codename1.io.FileSystemStorage.getInstance().openInputStream(path);
            Image i = Image.createImage(is);
            ImageViewer view = new ImageViewer(i.scaledWidth(Display.getInstance().getDisplayWidth()));
            return view;
        } catch (Exception ex) {
            ex.printStackTrace();
        } finally {
            try {
                is.close();
            } catch (IOException ex) {
                ex.printStackTrace();
            }
        }
        return null;

    }
 //To change body of generated methods, choose Tools | Templates.
                    
                });

            }
        });
       
          filter.addDataChangedListener((type, index) -> {
              ArrayList<User > filtred_users = new ArrayList<>();
              for (User userr : listUsers){
                  if (userr.getUsername().startsWith(filter.getText()))
                      filtred_users.add(userr);
              }
              ctn.removeAll();
              setUsers(filtred_users);
              
              revalidate();
          });
          ctn1.add(filter);
  
  
  
    
       

   //   lb.setText(serviceQuestion.getListQuestion().toString());//hatina fl lb resultat mtaa lmethode getList2()
     
 
   listUsers=userService.getAll();
   setUsers(listUsers);

      add(ctn1);
         add(ctn);
          getToolbar().addCommandToRightBar("retour", null, (ev)->{new HomeForm(theme,user).show();
          });
        
    }
      private void setUsers(ArrayList<User> listUsers) {
    
       for (User user :listUsers ){
     
          MultiButton mb= new MultiButton(user.getUsername());
             
          final FontImage placeholderImage =FontImage.createMaterial(FontImage.MATERIAL_PERSON,"label", 6);
           
          mb.setIcon(placeholderImage);
           mb.setTextLine2(user.getRoles());
          
       mb.addActionListener( (evt) -> {
           
         
        
       }
       
       );
        ctn.add(mb);
       Button btn_supprimer = new Button("supprimer");
         ctn.add(btn_supprimer);
    
         
        btn_supprimer.addActionListener( (evt) -> {
            if(Dialog.show("voulez vous supprimer cet utilisateur?", "", "oui", "Non")){
                 UserService userService = new UserService();
          userService.deleteUser(user.getId());
          try {
              File file=null;
          mailUtil.sendMail("seifeddine.fathallah@esprit.tn","kharbecherayen19@gmail.com","11061999soumaya","alert Utilisateur","cet utilisateur a éte supprimer"+user.getUsername(),file);
      } catch (Exception ex) {
         // Logger.getLogger(ListEventForm.class.getName()).log(Level.SEVERE, null, ex);
      }
          ctn.removeComponent(mb);
          ctn.removeComponent(btn_supprimer);
          refreshTheme();
            }
         
  
          
       }  );
        
       }
    }
     
}
