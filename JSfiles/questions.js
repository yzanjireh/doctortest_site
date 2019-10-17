
// first way of creating object
// create course object
//var Course={   
//    courseId:0,
//    courseState:0,
//    coursePrice:0,
//    courseFig:"",
//    courseInfo:"",
//    courseTitle:"",
//    courseUrl:"",
//    courseTyp:0,
//    branchId:0,
//    loadfiles:function(){
//    }
//};
// create a constructor for coursesNote: 
// A constructor function name usually starts with a capital letter — this convention is used to make constructor functions easier to recognize in code.

function Course(courseId,courseState,coursePrice,courseFig,courseInfo,courseTitle,courseUrl,courseTyp,branchId) {//,
  this.courseId = courseId;
    this.courseState = courseState;
    this.coursePrice = coursePrice;
    this.courseFig = courseFig;
    this.courseInfo = courseInfo;
    this.courseTitle = courseTitle;
    this.courseUrl=courseUrl;
    this.courseTyp=courseTyp;
    this.branchId=branchId;
  this.loadfiles = function() { 
    alert('Hi! I\'m ' + this.courseId + '.');
  };
};
// second way of creating object using constructor
// create object using constructor
//var course10002=new Course(10002,0);
//var course10004=new Course(10004);
var course10005=new Course(10005);

// third way of making objects
// 
var course10002=new Object();
course10002.courseId=10002;
course10002.loadfiles= function(){
    alert('Hi! I\'m ' + this.courseId + '.');
};
 
 // JavaScript has a built-in method called create() that allows you to do that. With it, you can create a new object based on any existing object.
 var course10004 = Object.create(course10002);
 
 //prototypes
 
 
 
 
 
//boughtcourse a child of course

function boughtcourse(courseId,price) {
    // call constructor of course
  Course.call(this, courseId);

  this.price = price;
}
boughtcourse.prototype = Object.create(Course.prototype);
boughtcourse.prototype.constructor = boughtcourse;
boughtcourse.prototype.cost=function(){
    var price= this.price;
    alert("this is the "+price);
    
};
var boughtcourse2 =new boughtcourse(10002,100);


// create object package
var Package={
    packageId:0,
    packageState:0,
    packagePrice:0,
    packageFig:"",
    packageInfo:"",
    packageTitle:"",
    packageUrl:"",
    packageTyp:0,
    branchId:0    
};


var Tests={    
    qId:0,   
    qType:0,
    qNo:0,
    qTitle:"",
    qText:"",
    qFig1:"",
    qFig2:"",
    qat:"",
    qafig:"",
    qbt:"",
    qbfig:"",
    qct:"",
    qcfig:"",
    qdt:"",
    qdfig:"",
    answer:"",
    qAns:"",
    aFig1:"",
    aFig2:"",
    qDesc:""   
};


