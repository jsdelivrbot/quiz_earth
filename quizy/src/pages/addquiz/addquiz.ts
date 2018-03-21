
import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { AlertController } from 'ionic-angular';
import { BarcodeScanner } from '@ionic-native/barcode-scanner';
import { Toast } from '@ionic-native/toast';
import { DataServiceProvider } from '../../providers/data-service/data-service';
import {Subscription} from 'rxjs/Subscription';
import {FormBuilder, FormGroup, FormControl, Validators} from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import { ServiceProvider } from '../../providers/service/service';
import { AboutPage } from '../about/about';

/**
 * Generated class for the AddquizPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
  selector: 'page-addquiz',
  templateUrl: 'addquiz.html',
})
export class AddquizPage {
  public tokenForm : FormGroup;
  public token : FormControl;

  items;
  products: any[] = [];
  selectedProduct: any;
  productFound:boolean = false;
  sub : Subscription;
  check : any;
  res : any;


  public reportForm : FormGroup;
  public id_quiz_name : FormControl;


  constructor( public fb : FormBuilder,  
    public navCtrl: NavController,
    private barcodeScanner: BarcodeScanner,
    private toast: Toast,
    public http: HttpClient,
    private alertCtrl : AlertController,
    public dataService: DataServiceProvider,
    public shareService: ServiceProvider) {

      this.id_quiz_name = fb.control('', Validators.required);
      this.reportForm = fb.group({
        'id_quiz_name': this.id_quiz_name, 
      })


      this.token = fb.control('', Validators.required);
      this.tokenForm = fb.group({
        'token': this.token
      })


        this.dataService.getProducts()
          .subscribe((response)=> {
              this.products = response
              console.log(this.products);
          });


  }

  searchquiz(){
    let token = this.tokenForm.controls['token'].value; 
   
    console.log(token);
    this.selectedProduct = this.products.find(product => product.token === token);
      if(this.selectedProduct !== undefined) {
        this.productFound = true;
        console.log(this.selectedProduct);
      } else {
        this.selectedProduct = {};
        this.productFound = false;
        this.toast.show('ไม่พบข้อมูลแบบทดสอบหรือแบบทดสอบได้ปิดแล้ว', '5000', 'center').subscribe(
          toast => {
            console.log(toast);
          }
        );
      }

  }


  scan() {
    this.selectedProduct = {};
    this.barcodeScanner.scan().then((barcodeData) => {
      this.selectedProduct = this.products.find(product => product.token === barcodeData.text);
      if(this.selectedProduct !== undefined) {
        this.productFound = true;
        console.log(this.selectedProduct);
      } else {
        this.selectedProduct = {};
        this.productFound = false;
        this.toast.show('ไม่พบข้อมูลแบบทดสอบหรือแบบทดสอบได้ปิดแล้ว', '5000', 'center').subscribe(
          toast => {
            console.log(toast);
          }
        );
      }
    }, (err) => {
      this.toast.show(err, '5000', 'center').subscribe(
        toast => {
          console.log(toast);
        }
      );
    });
  }


  gotoMap(){  
    // Sharing data using service
    //this.shareService.setUserData(this.res);
    this.navCtrl.push(AboutPage);
  }



  includeQuiz(){
    let id_quiz_name = this.reportForm.controls['id_quiz_name'].value;
    let id_stu = this.shareService.usrData.id_stu;
   
    let data = JSON.stringify({
      'id_quiz_name':id_quiz_name,
      'id_stu':id_stu
    });

    console.log(this.shareService.usrData.id_stu);

    this.http.post('http://www2.cgistln.nu.ac.th/quiz_earth/include_quiz.php', data)
    .subscribe(res => {
       this.res = res;
       console.log(res);
      
      if (this.res.message == 'error-email') {
        let alert=this.alertCtrl.create({
          title: '<h5>เคยเพิ่มแบบสอบถามนี้แล้ว</h5>',
          subTitle: 'กรุณาลองเปลี่ยน token หรือเริ่มแบบทดสอบเดิม',
          buttons:['ok']
        });
        alert.present();     
          //this.gotoindex();  
          
      }else if(this.res.message == 'success'){
        let alert=this.alertCtrl.create({
          title: '<h5>เพิ่มแบบสอบถามเรียบร้อยแล้ว</h5>',
          subTitle: 'เริ่มทำแบบทดสอบได้',
          buttons:['ok']
        });
        alert.present();     
        this.gotoMap();    
      }      
    }, error => {
      console.log("Oooops!");
    });


  }

  


}
