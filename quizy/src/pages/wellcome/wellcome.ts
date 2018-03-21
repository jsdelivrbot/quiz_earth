import { TabsPage } from './../tabs/tabs';
import {Component} from '@angular/core';
import {IonicPage, NavController, LoadingController, AlertController, Modal, ModalController, Events} from 'ionic-angular';
import {FormBuilder, FormGroup, FormControl, Validators} from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import { ServiceProvider } from '../../providers/service/service';

import { RegisterPage } from '../register/register';
//import { TabsPage } from '../tabs/tabs';
//import { MapPage } from '../map/map';
@IonicPage()
@Component({
  selector: 'page-wellcome',
  templateUrl: 'wellcome.html',
})
export class WellcomePage {

  public reportForm : FormGroup;
  public username_stu : FormControl;
  public pass_stu : FormControl;
  public res: any;

  constructor(
    public fb : FormBuilder,  
    private navCtrl : NavController, 
    private loadingCtrl : LoadingController,
    private alertCtrl : AlertController,
    private modalCtrl: ModalController,
    public http: HttpClient,
    public shareService: ServiceProvider,
    public events: Events
  ){
    console.log(shareService.center);
    this.username_stu = fb.control('', Validators.required);
    this.pass_stu = fb.control('', Validators.required);
    this.reportForm = fb.group({
      'username_stu': this.username_stu, 
      'pass_stu': this.pass_stu
    })
  }

  signup(){
    this.navCtrl.push(RegisterPage);
  }

  submit() {
    let loader = this.loadingCtrl.create({content: "กำลังเข้าสู่ระบบ.."});  
    let username_stu = this.reportForm.controls['username_stu'].value;
    let pass_stu = this.reportForm.controls['pass_stu'].value;
   
    let data = JSON.stringify({
      'username_stu':username_stu,
      'pass_stu':pass_stu
    });

    loader.present();    
    this.http.post('http://www2.cgistln.nu.ac.th/quiz_earth/service/checklogin.php', data)
    .subscribe(res => {
       this.res = res;
       console.log(res);
      
      if (this.res.message == 'error') {
         loader.dismiss();      
          let alert=this.alertCtrl.create({
            title: '<h5>ชื่อผู้ใช้หรือรหัสผ่านของท่านไม่ถูกต้อง!</h5>',
            subTitle: 'กรุณาลองอีกครั้ง หรือสมัครสมาชิกใหม่',
            buttons:['ok']
          });
          alert.present();     
      }else if(this.res.message == 'success'){
         loader.dismiss(); 
          this.gotoindex();    
      }      
    }, error => {
      console.log("Oooops!");
      loader.dismiss();
    });
  }  

  gotoindex(){  
    // Sharing data using service
    this.shareService.setUserData(this.res);
    this.navCtrl.push(TabsPage);
  }

  gotoForgot(){
    const modalLeg: Modal =  this.modalCtrl.create('ForgetPage');
    modalLeg.present();
  }

  
 
  ionViewDidLoad() {
    this.shareService.getLatLon();
  }  



}