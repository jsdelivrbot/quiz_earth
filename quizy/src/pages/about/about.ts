import { Component, ViewChild, ElementRef } from '@angular/core';
import { NavController } from 'ionic-angular';
import { LocationTrackerProvider } from '../../providers/location-tracker/location-tracker';
import { Geolocation } from '@ionic-native/geolocation';
import L from 'leaflet';
import {HttpClient} from '@angular/common/http';
import { Platform, ActionSheetController } from 'ionic-angular';
import { ServiceProvider } from '../../providers/service/service';


@Component({
  selector: 'page-about',
  templateUrl: 'about.html'
})
export class AboutPage {
  @ViewChild('map')mapContainer : ElementRef;
  map : L.map;  
  center : any;
  marker : any;
  circle : any;

  public i = [];

  constructor(public navCtrl: NavController, 
    public locationTracker: LocationTrackerProvider,
    public geoLocation : Geolocation,
    public http: HttpClient,
    public platform: Platform,
    public actionsheetCtrl: ActionSheetController,
    public shareService: ServiceProvider) {
      console.log(shareService.lat);
      console.log(shareService.lng);
  }

 
  ionViewDidLoad() {
    this.shareService.getLatLon();
    this.loadMap();
  }  



  loadMap() {
   
    let lat = this.shareService.lat;
    let lng = this.shareService.lng;


   //this.geoLocation.getCurrentPosition().then((res) => {


      this.center = [lat , lng];      
      let pos = [lat  , lng];
      console.log(this.center);


      // this.center = [16.746003, 100.193594];      
      // let pos = [16.746003, 100.193594];
      // console.log(this.center);



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
  

      let id_stu = this.shareService.usrData.id_stu;

      let data = JSON.stringify({
        'id_stu':id_stu,
        'lat' : lat,
        'lon' : lng
      });
      
console.log('data : ',data)
      this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/marker.php?type=2",data)
      .subscribe(res => {

         for (let i in res) {
         L.marker([Number(res[i].lat), Number(res[i].lon)]).addTo(this.map);
         console.log(res);
           }

      })    
       

      this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/marker.php?type=1",data)
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
    
      var greenIcon = new LeafIcon({iconUrl: 'http://icon-park.com/imagefiles/location_map_pin_orange5.png'});

      this.marker = L.marker(pos, {icon: greenIcon}).addTo(this.map);
      this.circle = L.circle(pos, {radius: 200}).addTo(this.map);   


      
      setInterval(() => {

        this.map.removeLayer(this.marker)
        this.map.removeLayer(this.circle)

       this.marker = L.marker(pos, {icon: greenIcon}).addTo(this.map);
       this.circle = L.circle(pos, {radius: 200}).addTo(this.map);   

     }, 1500);



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
          icon: !this.platform.is('ios') ? 'paper-plane' : null,
          handler: () => {
            console.log(res.chioce_1);

            let id_stu = this.shareService.usrData.id_stu
            let id_quiz = res.id_quiz

              let data = JSON.stringify({
                'id_stu':id_stu,
                'id_quiz' : id_quiz,
                'select' : 'select1'
              });
              console.log(data);

                this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/insert_check.php",data)
                .subscribe(res => { console.log(res);})    
          }
        },
        {
          text: res.chioce_2,
          icon: !this.platform.is('ios') ? 'paper-plane' : null,
          handler: () => {
            console.log(res.chioce_2);

            let id_stu = this.shareService.usrData.id_stu
            let id_quiz = res.id_quiz

              let data = JSON.stringify({
                'id_stu':id_stu,
                'id_quiz' : id_quiz,
                'select' : 'select2'
              });
              console.log(data);

                this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/insert_check.php",data)
                .subscribe(res => { console.log(res);})    
          }
        },
        {
          text: res.chioce_3,
          icon: !this.platform.is('ios') ? 'paper-plane' : null,
          handler: () => {
            console.log(res.chioce_3);

            let id_stu = this.shareService.usrData.id_stu
            let id_quiz = res.id_quiz

              let data = JSON.stringify({
                'id_stu':id_stu,
                'id_quiz' : id_quiz,
                'select' : 'select3'
              });
              console.log(data);

                this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/insert_check.php",data)
                .subscribe(res => {console.log(res); })    
          }
        },
        {
          text: res.chioce_4,
          icon: !this.platform.is('ios') ? 'paper-plane' : null,
          handler: () => {
            console.log(res.chioce_4);

            let id_stu = this.shareService.usrData.id_stu
            let id_quiz = res.id_quiz

              let data = JSON.stringify({
                'id_stu':id_stu,
                'id_quiz' : id_quiz,
                'select' : 'select4'
              });
              console.log(data);

                this.http.post("http://www2.cgistln.nu.ac.th/quiz_earth/service/insert_check.php",data)
                .subscribe(res => { console.log(res);})    
          }
        }
      ]
    });
    actionSheet.present();
  }

 
}