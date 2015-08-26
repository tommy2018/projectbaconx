<?php 
if ($user = $this->getVar('user')) include_once 'template-header.php'; else include_once 'template-header-guest.php';
$entity = $this->getVar('entity');
?>

<div id="main">
  <div class="container-fluid" id="main_frame">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="project_card">
          <div id="project_card_menu"><i class="fa fa-cubes"></i> <span id="project_card_menu_title"><?php echo $entity->getName(); ?></span>
            <div id="project_card_menu_buttons">
              <a href="<?php echo 'edit-entity/1' ?>"><i class="fa fa-pencil"></i></a>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-8">
                <div class="row">
                  <div class="col-lg-12">
                    <div id="project_information_card" class="card">
                      <div class="card_top"> <span class="card_title"><i class="fa fa-leaf"></i> INFORMATION<br>
                        </span> </div>
                      <div class="card_content">
                        <div style="color:#4F4F4F;"> <span style="font-size:22.5px; margin-bottom:8px; display: block;"><?php echo $entity->getName(); ?><br>
                          </span> <span style="color:#7D7D7D; font-size:15px;">Computer Science Undergraduate Final Year Project</span>
                          <hr>
                          <div style="padding:20px 15px 0 15px;"> <span style="color:#00BCD4; display:block; margin-bottom:15px; font-size:18px;">DESCRIPTION <i class="fa fa-chevron-up"></i></span> <span style="font-size:18.5px; display:block; line-height:180%; text-align:justify; margin-bottom:50px;"> The project aims to provide an all-in-one solution to manage all aspects of CSCI321, from group formation and user creation to marking and the final trade show. The project will be made customizable enough such that it can be adopted by other schools or organizations who wish to host trade shows that are similar. The project focuses heavily on end users and information management. Administrators will be able to customize and run multiple trade shows concurrently. The final system will also serves as a platform to provide relevant information to all stakeholders who are involved in trade shows. Each project group in the trade show will be able to customize their information and provide relevant documents. Judges and markers will be able to mark and provide feedbacks for the projects. And finally, anyone will be able to anonymously view the website and browse information about projects that are available to the general public. The project will also provide a mobile application on iOS devices. The mobile application will be able to provide proximity support so that users can view closest projects during the day of the trade show in addition to all the functionalities that the main system provides. </span>
                            <hr>
                            <span style="color:#00BCD4; display:block; margin-bottom:15px; font-size:18px;">TECHNOLOGY <i class="fa fa-chevron-up"></i></span>
                            <hr>
                            <span style="color:#00BCD4; display:block; margin-bottom:15px; font-size:18px;">WEBSITE <i class="fa fa-chevron-down"></i></span>
                            <hr>
                            <span style="color:#00BCD4; display:block; margin-bottom:15px; font-size:18px;">FUNCTIONS <i class="fa fa-chevron-down"></i></span> </div>
                        </div>
                      </div>
                      <div class="bottom"> </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div id="media_card" class="card">
                      <div class="card_top"> <span class="card_title"><i class="fa fa-film"></i> MEDIA</span> </div>
                      <div class="card_content">
                        <div id="media_card_no_contents">NO MEDIA AVAILABLE</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div id="group_members_card" class="card">
                  <div class="card_top"> <span class="card_title"><i class="fa fa-users"></i> GROUP MEMBERS</span> </div>
                  <div class="card_content">
                    <ul id="group_members_card_member_list">
                      <li>Man Pio Lei</li>
                      <hr>
                      <li>Zhen Huang</li>
                      <hr>
                      <li>Mengzhe Wang</li>
                      <hr>
                      <li>Guannan Yao</li>
                      <hr>
                      <li>Huicheng Xu</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
