class myClass {
	
		constructor(name){
			this.name = name;

		}
		get name(){
			return this._name;
		}
		set  name(value){
			if(value.length<4){
				alert("name is too short");
				return;
			}else{
				return this._name = value;
			}
		}


}