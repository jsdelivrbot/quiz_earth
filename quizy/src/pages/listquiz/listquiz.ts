import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {HttpClient} from '@angular/common/http';

import { ServiceProvider } from '../../providers/service/service';
import { MapquizPage } from '../mapquiz/mapquiz';
/**
 * Generated class for the ListquizPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-listquiz',
  templateUrl: 'listquiz.html',
})
export class ListquizPage {
  res : any;

  constructor(public navCtrl: NavController, 
    public navParams: NavParams,
    public http: HttpClient,
    public shareService: ServiceProvider) {

      let id_stu = this.shareService.usrData.id_stu;

      let data = JSON.stringify({
        'id_stu':id_stu
      });
      console.log(data);


         
      this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/list_quiz.php",data)
      .subscribe(res => {
        this.res = res;
        console.log(res);
      })  
  }


  viewmap(c):void {
    this.navCtrl.push(MapquizPage,{
      id_quiz_group : c.id_quiz_group,
      quiz_title : c.quiz_title

    });
    }


}



