import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { TabsPage } from './../tabs/tabs';
/**
 * Generated class for the WellcomePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-wellcome',
  templateUrl: 'wellcome.html',
})
export class WellcomePage {

  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad WellcomePage');
  }

  
  gotoindex(){
  
    // Sharing data using service
    // this.shareService.setUserData(this.res);
    this.navCtrl.push(TabsPage);
  }


}
