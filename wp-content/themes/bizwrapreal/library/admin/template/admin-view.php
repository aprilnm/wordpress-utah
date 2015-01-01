<div class="wrap">
    <div id="bw_theme_admin">
        <div id="top-container">
            <div id="bw-title">
                <h1>Bizwrap</h1>
            </div>
            <div class="clear-both"></div>
        </div>
        <div class="bw_wrap_box">
            <div class="bw_box_opt">
                <?php if (isset($_POST['BW_display_admin_form_submit'])) { ?>
                    <div class="success-message">
                        <p><?php echo "Settings saved"; ?></p>
                    </div>
                <?php } ?>
                <form enctype="multipart/form-data" id="post" method="post" encoding="multipart/form-data">
                    <div id="bw_tabs" class="bw_tabs">
                        <div class="bw_tabs-column">
                            <ul>
                                <li class="open"><a href="#general-settings" class="open"><span>General settings</span></a></li>
                                <li class="closed"><a href="#blog-section" class="closed"><span>Blog</span></a></li>
                                <li class="closed"><a href="#portfolio-section" class="closed"><span>Portfolio</span></a></li>
                                <li class="closed"><a href="#social-share-section" class="closed"><span>Social Share</span></a></li>
                                <li class="closed"><a href="#Contact-section" class="closed"><span>Map</span></a></li>
                                <li class="closed"><a href="#custom-css" class="closed"><span>Custom CSS</span></a></li>
                            </ul>
                        </div>
                        <?php $bw_theme_options = get_option('bizwrap_theme_options'); ?>
                        <!-- ---------------------- General settings ------------------------------ -->
                        <div class="bw_tabs-content-column">
                            <div id="general-settings" class="bw_tabs-content-panel" style="display: none;">
                                <div class="bw_input_box ">
                                    <label>Logo Image:</label>
                                    <input type="text" value="<?php echo $bw_theme_options['logo_img'] ?>" name="bizwrap_theme_options[logo_img]" id=bizwrap_theme_options_logo_img_>
                                    <input type="button" value="Upload Image" class="button bw_upload_image" input-data="bizwrap_theme_options_logo_img_" id="upload_buffer_button">
                                    <small>Upload a Header Logo.</small>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bw_input_box ">
                                    <label>Favicon Image</label>
                                    <input type="text" value="<?php echo $bw_theme_options['favicon_img'] ?>" name="bizwrap_theme_options[favicon_img]" id=bizwrap_theme_options_favicon_img>
                                    <input type="button" value="Upload Image" class="button bw_upload_image" input-data="bizwrap_theme_options_favicon_img" id="upload_buffer_button">
                                    <small> Upload a favicon.</small>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bw_input_box bw_select_box">
                                    <label>Top header widget</label>
                                    <select size="1" name="bizwrap_theme_options[top_widget]">
                                        <option value="0" >No</option>
                                        <option value="1" <?php if ($bw_theme_options['top_widget'] == '1') echo 'selected="selected"'; ?>>Yes</option>
                                    </select>
                                    <small>Active top header widget.</small>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bw_input_box footer-copy-text">
                                    <label>Footer Copyright Text</label>
                                    <textarea rows="" cols="" type="textarea" name="bizwrap_theme_options[footer_copyright]"><?php echo $bw_theme_options['footer_copyright'] ?></textarea>
                                    <small>Copyright information on the bottom of site</small>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- ---------------------- BLOG SETTING ------------------------------ -->
                            <div id="blog-section" class="bw_tabs-content-panel" style="display: none;">
                                <div class="bw_input_box">
                                    <label>Post Per page:&nbsp;</label>
                                    <input type="number" name="bizwrap_theme_options[blog_per_page]" min="1" value="<?php echo $bw_theme_options['blog_per_page'] ?>" />
                                    <small>Blog pages show at most</small> </div>
                                <div class="bw_input_box">
                                    <label>Blog Layout:</label>
                                    <select size="1" name="bizwrap_theme_options[blog_layout]">
                                        <option value="1">1 column </option>                                        
                                        <option value="2" <?php if ($bw_theme_options['blog_layout'] == '2') echo 'selected="selected"'; ?>>2 columns</option>
                                        <option value="3" <?php if ($bw_theme_options['blog_layout'] == '3') echo 'selected="selected"'; ?>>3 columns </option>
                                        <option value="4" <?php if ($bw_theme_options['blog_layout'] == '4') echo 'selected="selected"'; ?>>4 columns (No Sidebar)</option>
                                        <option value="22" <?php if ($bw_theme_options['blog_layout'] == '22') echo 'selected="selected"'; ?>>2 columns layout 2</option>
                                        <option value="32" <?php if ($bw_theme_options['blog_layout'] == '32') echo 'selected="selected"'; ?>>3 columns layout 2</option>
                                        <option value="1_sliderbar" <?php if ($bw_theme_options['blog_layout'] == '1_sliderbar') echo 'selected="selected"'; ?>>1 columns + Sidebar</option>
                                        <option value="2_sliderbar" <?php if ($bw_theme_options['blog_layout'] == '2_sliderbar') echo 'selected="selected"'; ?>>2 columns + Sidebar</option>
                                        <option value="3_sliderbar" <?php if ($bw_theme_options['blog_layout'] == '3_sliderbar') echo 'selected="selected"'; ?>>3 columns + Sidebar</option>
                                    </select>
                                    <small>Choose between available layout.</small> </div>
                            </div>
                            <!-- --------------------------------------PORTFOLIO SETTING---------------------------------- -->
                            <div id="portfolio-section" class="bw_tabs-content-panel" style="display: none;">
                                <div class="bw_input_box">
                                    <label>Portfolio Per page:&nbsp;</label>
                                    <input type="number" name="bizwrap_theme_options[portfolio_per_page]" min="1" value="<?php echo $bw_theme_options['portfolio_per_page'] ?>" />
                                    <small>Portfolio pages show at most</small> </div>
                                <div class="bw_input_box">
                                    <label>Portfolio Layout:</label>
                                    <select size="1" name="bizwrap_theme_options[portfolio_layout]">
                                        <option value="2" <?php if ($bw_theme_options['portfolio_layout'] == '2') echo 'selected="selected"'; ?>>2 columns</option>
                                        <option value="3" <?php if ($bw_theme_options['portfolio_layout'] == '3') echo 'selected="selected"'; ?>>3 columns </option>
                                        <option value="4" <?php if ($bw_theme_options['portfolio_layout'] == '4') echo 'selected="selected"'; ?>>4 columns </option>
                                        <option value="22" <?php if ($bw_theme_options['portfolio_layout'] == '22') echo 'selected="selected"'; ?>>2 columns layout 2</option>
                                        <option value="32" <?php if ($bw_theme_options['portfolio_layout'] == '32') echo 'selected="selected"'; ?>>3 columns layout 2 </option>                                        
                                        <option value="42" <?php if ($bw_theme_options['portfolio_layout'] == '42') echo 'selected="selected"'; ?>>4 columns layout 2</option>
                                    </select>
                                    <small>Choose between available layout.</small> </div>
                            </div>
                            <!-- --------------------------------------SOCIAL SHARE----------------------------------- -->
                            <div id="social-share" class="bw_tabs-content-panel" style="display: none; min-height: 459px;">
                                <div class="bw_input_box">
                                    <label>Facebook &nbsp;</label>
                                    <input type="text" name="bizwrap_theme_options[social_share][facebook]" value="<?php echo $bw_theme_options['social_share']['facebook'] ?>" />
                                    <small>Enter Facebook Url</small>
                                </div>
                                <div class="bw_input_box">
                                    <label>Twitter</label>
                                    <input type="text" name="bizwrap_theme_options[social_share][twitter]" value="<?php echo $bw_theme_options['social_share']['twitter'] ?>" />
                                    <small>Enter Twitter Url</small> </div>
                                <div class="bw_input_box">
                                    <label>Google +:</label>
                                    <input type="text" name="bizwrap_theme_options[social_share][googleplus]" value="<?php echo $bw_theme_options['social_share']['googleplus'] ?>" />
                                    <small>Enter Google Url</small> </div>
                                <div class="bw_input_box">
                                    <label>linkedin:</label>
                                    <input type="text" name="bizwrap_theme_options[social_share][linkedin]" value="<?php echo $bw_theme_options['social_share']['linkedin'] ?>" />
                                    <small>Enter linkedin Url</small> </div>
                                <div class="bw_input_box">
                                    <label>Pinterest:</label>
                                    <input type="text" name="bizwrap_theme_options[social_share][pinterest]" value="<?php echo $bw_theme_options['social_share']['pinterest'] ?>" />
                                    <small>Enter Pinterest Url</small> </div>
                            </div>
                            <!-- ------------------------------------------------CONTACT SETTING---------------------- -->
                            <div id="Contact-section" class="bw_tabs-content-panel" style="display: none;">
                                <div class="bw_input_box bw_select_box">
                                    <label>Active Map</label>
                                    <select size="1" name="bizwrap_theme_options[map][active_map]">
                                        <option value="0" >No</option>
                                        <option value="1" <?php if ($bw_theme_options['map']['active_map'] == '1') echo 'selected="selected"'; ?>>Yes</option>
                                    </select>
                                    <small>Active Google Map On Contact Page.</small>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bw_input_box">
                                    <label>Map Zoom:</label>
                                    <input type="text" name="bizwrap_theme_options[map][zoom]" value="<?php echo $bw_theme_options['map']['zoom'] ?>" />
                                    <small>Enter Addpress for google Map</small> </div>
                                <div class="bw_input_box bw_select_box">
                                    <label>Scrollwheel</label>
                                    <select name="bizwrap_theme_options[map][scrollwheel]">
                                        <option value="false" >No</option>
                                        <option value="true" <?php if ($bw_theme_options['map']['scrollwheel'] == 'true') echo 'selected="selected"'; ?>>Yes</option>
                                    </select>
                                    <small>Active Scrollwheel on google map.</small>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bw_input_box bw_select_box">
                                    <label>Draggable</label>
                                    <select name="bizwrap_theme_options[map][draggable]">
                                        <option value="false" >No</option>
                                        <option value="true" <?php if ($bw_theme_options['map']['draggable'] == 'true') echo 'selected="selected"'; ?>>Yes</option>
                                    </select>
                                    <small>Active draggable on google map.</small>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bw_input_box contact-info">
                                    <label>Address</label>
                                    <textarea rows="5" cols="4" type="textarea" name="bizwrap_theme_options[map][contact_address]"><?php echo $bw_theme_options['map']['contact_address'] ?></textarea>
                                    <small>Enter address for google Map Example: Sydney, New South Wales, Australia</small> </div>
                            </div>
                            <!-------- -------------------------CUSTOM CSS------------------------------ -->
                            <div id="custom-css" class="bw_tabs-content-panel" style="display: none;">
                                <div class="bw_input_box">
                                    <label>Custom CSS</label>
                                    <textarea rows="" cols="" type="textarea" name="bizwrap_theme_options[custom_css]"><?php if ($bw_theme_options['custom_css']) echo $bw_theme_options['custom_css']; ?>
                                    </textarea>
                                    <small>Add any custom css here. It will override the default values . <br>
                                        e.g.; .classname{background:#fff}</small>
                                    <div class="clear-both"></div>
                                </div>
                            </div>
                            <!-- ////////////////////////// UPLOAD ////////////////////////// -->
                        </div>
                    </div>
                    <div id="submit-box">
                        <input type="submit" value="Save changes" name="BW_display_admin_form_submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
