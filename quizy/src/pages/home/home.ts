import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

import { AboutPage } from '../about/about';
import { AddquizPage } from '../addquiz/addquiz';
import { ListquizPage } from '../listquiz/listquiz';
import { PointPage } from '../point/point';
import { ServiceProvider } from '../../providers/service/service';
import {Subscription} from 'rxjs/Subscription';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
 
  sub : Subscription;
  items : any;

  constructor(public navCtrl: NavController, 
    public navParams: NavParams,
    public shareService: ServiceProvider) {

      console.log(shareService.lat);
      console.log(shareService.lng);
      console.log(shareService.center);

  }



  ionViewDidLoad() {
    this.shareService.getLatLon();
  }  
  

  gotoAbout(){
    this.navCtrl.push(AboutPage);
  }

  gotoAddquiz(){
    this.navCtrl.push(AddquizPage);
  }

  gotoListquiz(){
    this.navCtrl.push(ListquizPage);
  }

  gotoPoint(){
    this.navCtrl.push(PointPage);
  }

}