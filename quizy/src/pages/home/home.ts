import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

import { AboutPage } from '../about/about';
import { AddquizPage } from '../addquiz/addquiz';
import { ListquizPage } from '../listquiz/listquiz';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
 
  constructor(public navCtrl: NavController, public navParams: NavParams) {
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

}