<div id="main-content">
            	
                <div class="row-fluid">
                    <div class="span12">
                        <div class="breadcrumb clearfix">
                            <span></span>
                            <a href="./">Home</a>
                            <span>/</span>
                            <span class="current-page">Gallery</span>
                        </div>
                    </div><!--span12-->
                </div><!--row-fluid-->
                
                <div class="row-fluid">
                	<div class="span12">
                        
						<div class="flexslider kp-gallery-slider">
						  <ul class="slides">
                          <?php 
                             $gambarHotb=mysql_query("SELECT * FROM gallery ORDER BY tgl DESC LIMIT 8");
                                    while($regb=mysql_fetch_array($gambarHotb)){   
                          ?>
							<li>
								<div class="mask">
									<a href="img_album/<?php echo $regb['gbr_gallery']; ?>" rel="prettyPhoto[]"><img src="img_album/<?php echo $regb['gbr_gallery']; ?>" alt="<?php echo $regb['jdl_gallery']; ?>" title="<?php echo $regb['jdl_gallery']; ?>" /></a>
								</div>
								<div class="kp-gallery-caption">
									<?php echo $regb['keterangan']; ?>
								</div>
							</li>
							<?php 
                                }
                            ?>
						  </ul>
						</div>
						<div class="flexslider kp-gallery-carousel">
						  <ul class="slides">
                          <?php 
                            $gambarHot=mysql_query("SELECT * FROM gallery ORDER BY tgl DESC LIMIT 8");
                                    while($reg=mysql_fetch_array($gambarHot)){
                          ?>
							<li><img src="img_album/small_<?php echo $reg['gbr_gallery']; ?>" alt="<?php echo $reg['jdl_gallery']; ?>" title="<?php echo $reg['jdl_gallery']; ?>"/></li>
						  <?php 
                            }
                          ?>
						  </ul>
						</div><!--kp-gallery-slider-->
                                        
                    </div><!--span12-->
                </div><!--row-fluid-->
                
                <div class="widget-area-12">
                
                	<div class="kopa-divider"></div>
                    
                    <div class="widget kopa-entry-list-widget">
                        <h3 class="widget-title clearfix">
                            <span class="title-text">Lihat Lainnya
                                <span class="triangle-right"></span>
                                <span class="triangle-left"></span>
                                <span class="triangle-bottom"></span>
                            </span>
                            <span class="title-right">Lihat Lainnya</span>
                        </h3>
                        <ul class="kopa-entry-list clearfix">
                        <?php 
                            $gambarHot=mysql_query("SELECT * FROM gallery ORDER BY tgl ASC LIMIT 6");
                                    while($reg=mysql_fetch_array($gambarHot)){
                        ?>
                            <li>
                                <article class="entry-item">
                                    <div class="entry-thumb kp-gallery-slider">
                                        <a href="img_album/<?php echo $reg['gbr_gallery']; ?>" rel="prettyPhoto[kp-gallery]"><img src="img_album/<?php echo $reg['gbr_gallery']; ?>" rel="prettyPhoto[kp-gallery]" alt="<?php echo $reg['jdl_gallery']; ?>" title="<?php echo $reg['jdl_gallery']; ?>" /></a>
                                    </div>
                                    
                                    <div class="entry-content">
                                        <header>
                                            <h4 class="entry-title"><a href="gambarTop.html" ><?php echo $reg['jdl_gallery']; ?></a></h4>
                                        </header>

                                    </div>

                                </article>
                            </li>
                        <?php 
                            }
                        ?>                                            
                        </ul>
                        
                    </div><!--kopa-entry-list-widget-->
                	
                </div><!--widget-area-12-->
                
            </div><!--main-content-->