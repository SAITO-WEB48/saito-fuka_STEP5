let addCount=0;

document.getElementById("btn").addEventListener("click",function(){
   const textInput=document.getElementById("textInput");
   const text=textInput.value.trim();
   
   //空の場合アラート
 if(text === ""){
    alert("入力値は空です。");
    return;
 } 
   //入力　表示　on/off
    const display=document.getElementById("displayArea");
    display.textContent=text;
    display.classList.toggle("highlight");

   //テーブルに行を追加
    const table=document.getElementById("dataTable");
    const newRow=table.insertRow(-1);
    const cell1=newRow.insertCell(0);
    const cell2=newRow.insertCell(1);

    cell1.textContent=text;

   //削除
    const delBtn = document.createElement("button");
    delBtn.textContent = "削除";
    delBtn.addEventListener("click", function() {
      newRow.remove();

      addCount=Math.max(0,addCount - 1);

   //3未満「表示」ボタン復活
      if (addCount < 3){
         document.getElementById("btn").style.display="";

   //カウント
   let i=1;
   while(i<=5){
      console.log('ループ回数:${i}');
      i++;
   }
   }
});

   cell2.appendChild(delBtn);

   document.getElementById("textInput").value="";

   addCount++;
   console.log("追加回数:",addCount);
   
   //3回以上になったら「表示」ボタン非表示
      if(addCount>=3){
         document.getElementById("btn").style.display="none";
   }
});

   //背景色変更ボタン
const colors=["lightblue","lightgreen","lightcoral"];
let currentIndex=0;

document.getElementById("colorbtn").addEventListener("click",function(){
      document.body.style.backgroundColor=colors[currentIndex];
      currentIndex=(currentIndex+1)%colors.length;

});
