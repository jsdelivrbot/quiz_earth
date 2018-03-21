import {Component} from '@angular/core';
import {IonicPage, NavController, LoadingController, ToastController, AlertController} from 'ionic-angular';
import {Camera, CameraOptions} from '@ionic-native/camera';
import {FormBuilder, FormGroup, FormControl, Validators} from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer';

// import {HomePage} from '../home/home';
import {WellcomePage} from '../wellcome/wellcome';

@IonicPage()
@Component({
  selector: 'page-register', 
  templateUrl: 'register.html'
})

export class RegisterPage {
  public reportForm : FormGroup;
  public name_stu : FormControl;
  public lname_stu : FormControl;
  public tel_stu : FormControl;
  public school : FormControl;
  public level_stu : FormControl;
  public username_stu : FormControl;
  public pass_stu : FormControl;
  public imageURI:any;
  public imageFileName:any;
  public res: any;

  constructor(
    private transfer: FileTransfer,
    public fb : FormBuilder,  
    private camera : Camera, 
    private navCtrl : NavController, 
    //private navParams : NavParams, 
    private loadingCtrl : LoadingController,
    private alertCtrl: AlertController,
    public toastCtrl: ToastController,
    public http: HttpClient)
  {
    //this.location= navParams.get('location');
    this.name_stu = fb.control('', Validators.required);
    this.lname_stu = fb.control('', Validators.required);
    this.tel_stu = fb.control('', Validators.required);
    this.school = fb.control('', Validators.required);
    this.level_stu = fb.control('', Validators.required);
    this.username_stu = fb.control('', Validators.required);
    this.pass_stu = fb.control('', Validators.required);
    this.reportForm = fb.group({
      'name_stu': this.name_stu, 
      'lname_stu': this.lname_stu, 
      'tel_stu': this.tel_stu, 
      'school': this.school, 
      'level_stu': this.level_stu, 
      'username_stu': this.username_stu, 
      'pass_stu': this.pass_stu,
    })
  }

  ionViewDidLoad() {
    //console.log(this.location);
  }

  takePicture() {
    const imgCam: CameraOptions={
      quality: 50,
      destinationType: this.camera.DestinationType.FILE_URI,
      sourceType: this.camera.PictureSourceType.CAMERA,
      encodingType: this.camera.EncodingType.JPEG
    }
    
    this.camera.getPicture(imgCam).then((imageData) => {
        this.imageURI = imageData;
        this.imageFileName=imageData.substr(imageData.lastIndexOf('/') + 1);
      }, (err) => {
        console.log(err);
      });
  }

  submit() {
    let loader = this.loadingCtrl.create({content: "กำลังบันทึกข้อมูล.."});    
    let name_stu = this.reportForm.controls['name_stu'].value;
    let lname_stu = this.reportForm.controls['lname_stu'].value;
    let tel_stu = this.reportForm.controls['tel_stu'].value;
    let school = this.reportForm.controls['school'].value;
    let level_stu = this.reportForm.controls['level_stu'].value;
    let username_stu = this.reportForm.controls['username_stu'].value;
    let pass_stu = this.reportForm.controls['pass_stu'].value;
    let img64 = this.imageFileName;
   
    let data = JSON.stringify({
      'name_stu':name_stu,
      'lname_stu':lname_stu,
      'tel_stu':tel_stu,
      'school':school,
      'level_stu':level_stu,
      'username_stu':username_stu,
      'pass_stu':pass_stu,
      'img64':img64
    });

    loader.present();    
    this.http.post('http://www2.cgistln.nu.ac.th/quiz_earth/insert.php', data)
    .subscribe(res => {
      this.res = res;
    	

    	if (this.res.message == 'error-email') {
    		 loader.dismiss(); 
		      this.gotoHome();      
		      let alert=this.alertCtrl.create({
		        title: 'ไม่สามารถบันทึกได้!',
		        subTitle: 'รหัสนักเรียนของท่านเคยมีการสมัครสมาชิกแล้ว กรุณาเข้าสู่ระบบ',
		        buttons:['ok']
		      });
		      alert.present();     
    	}else if(this.res.message == 'success'){
    		 loader.dismiss(); 
		      this.gotoHome();      
		      let alert=this.alertCtrl.create({
		        title: 'ลงทะเบียนเสร็จสิ้น',
		        subTitle: 'ท่านสามารถ Log in เข้าใช้งานระบบได้ทันที',
		        buttons:['ok']
		      });
		      alert.present();     
    	}else if(this.res.message == 'error-other'){
    		 loader.dismiss();     
		      let alert=this.alertCtrl.create({
		        title: 'ไม่สามารถบันทึกข้อมูลได้',
		        subTitle: 'กรุณาลองอีกครั้ง',
		        buttons:['ok']
		      });
		      alert.present();     
    	}

      
    }, error => {
      console.log("Oooops!");
      loader.dismiss();
    });

    //upload image
    const fileTransfer: FileTransferObject = this.transfer.create();
    let options: FileUploadOptions = {
      fileKey: 'file',
      fileName: this.imageFileName,      
      chunkedMode: false,
      mimeType: "image/jpeg",
      headers: {}
    }


  
    fileTransfer.upload(this.imageURI, 'http://www2.cgistln.nu.ac.th/quiz_earth/img_upload.php', options)
    .then(res => {   
      loader.dismiss(); 
      this.gotoHome();     
      //this.presentToast("Image uploaded successfully");
    }, (err) => {
      loader.dismiss();
      this.presentToast(err);
    });
  }  




  
  presentToast(msg) {
      let toast = this.toastCtrl.create({
        message: msg,
        duration: 6000,
        position: 'bottom'
      });  
      toast.onDidDismiss(() => {

        console.log('Dismissed toast');
      });  
      toast.present();
  } 

  gotoHome(){
      this.navCtrl.setRoot(WellcomePage, {
        
      })
  }

}