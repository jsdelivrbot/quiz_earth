import { Component, ViewChild, ElementRef } from '@angular/core';
import { NavController ,NavParams} from 'ionic-angular';
import { LocationTrackerProvider } from '../../providers/location-tracker/location-tracker';
import { Geolocation } from '@ionic-native/geolocation';
import L from 'leaflet';
import {HttpClient} from '@angular/common/http';
import { Platform, ActionSheetController } from 'ionic-angular';
import { ServiceProvider } from '../../providers/service/service';

/**
 * Generated class for the MapquizPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
  selector: 'page-mapquiz',
  templateUrl: 'mapquiz.html',
})
export class MapquizPage {
  @ViewChild('map')mapContainer : ElementRef;
  map : L.map;  
  center : any;
  marker : any;
  circle : any;

  public i = [];


  id_quiz_name : any;
  
  constructor(public navCtrl: NavController, 
    public navParams: NavParams,
    public locationTracker: LocationTrackerProvider,
    public geoLocation : Geolocation,
    public http: HttpClient,
    public platform: Platform,
    public actionsheetCtrl: ActionSheetController,
    public shareService: ServiceProvider
  ) {
      this.id_quiz_name = this.navParams.get('id_quiz_name'); 

      console.log(this.id_quiz_name);
  }

  ionViewDidLoad() {
    this.shareService.getLatLon();
    this.loadMap();
  }  
  
  loadMap() {
    let lat = this.shareService.lat;
    let lng = this.shareService.lng;
   // this.geoLocation.getCurrentPosition().then((res) => {
    this.center = [lat , lng];      
    let pos = [lat  , lng];
    console.log(this.center);
      //  this.center = [16.746003, 100.193594];      
      //  let pos = [16.746003, 100.193594];
      //  console.log(this.center);
 
 
 
       let mapOption = {
         center: this.center,
         zoom: 17
       };
   
       this.map = L.map('map', mapOption);
       this.marker = L.marker();
   
       L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attributions: 'OSM',
         maxZoom: 20
       }).addTo(this.map);
   
 
       let id_quiz_name = this.id_quiz_name = this.navParams.get('id_quiz_name'); 

       let data = JSON.stringify({
         'id_quiz_name':id_quiz_name
       });
       console.log(data);
 


       this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/marker_quiz.php",data)
       .subscribe(res => {
 
         for (let i in res) {
         L.marker([Number(res[i].lat), Number(res[i].lon)]).on('click', (e)=>{this.onMapClick(res[i])}).addTo(this.map);
         console.log(res);
          }
 
 
 
       })    
        
      
 
 
       var LeafIcon = L.Icon.extend({
         options: {
           iconSize:     [30, 40], // size of the icon
           iconAnchor:   [10, 30]
         }
       });
     
       var greenIcon = new LeafIcon({iconUrl: 'http://icon-park.com/imagefiles/location_map_pin_orange3.png'});
  
   
 
       this.marker = L.marker(pos, {icon: greenIcon}).addTo(this.map);
       this.circle = L.circle(pos, {radius: 200}).addTo(this.map);        
 
 
 
   // })
   
   } 


  onMapClick(res) {
    console.log(res);
    let actionSheet = this.actionsheetCtrl.create({
      title: res.quiz_name,
      cssClass: 'action-sheets-basic-page',
      buttons: [
        {
          text: res.chioce_1,
          icon: !this.platform.is('ios') ? 'checkmark' : null,
          handler: () => {
            console.log(res.chioce_1);
          }
        },
        {
          text: res.chioce_2,
          icon: !this.platform.is('ios') ? 'checkmark' : null,
          handler: () => {
            console.log(res.chioce_2);
          }
        },
        {
          text: res.chioce_3,
          icon: !this.platform.is('ios') ? 'checkmark' : null,
          handler: () => {
            console.log(res.chioce_3);
          }
        },
        {
          text: res.chioce_4,
          icon: !this.platform.is('ios') ? 'checkmark' : null,
          handler: () => {
            console.log(res.chioce_4);
          }
        },
        {
          text: 'cancel',
          role: 'cancel', // will always sort to be on the bottom
          icon: !this.platform.is('ios') ? 'close' : null,
          handler: () => {
            console.log('Cancel clicked');
          }
        }
      ]
    });
    actionSheet.present();
  }



}