{{-- TODO 查询界面--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">维修界面</div>
                    <div class="panel-body">
                        <div class="row">
                            @if($SearchOption == 0)
                                <div class="clear"></div>
                                <div class="up"><ul>
                                        <b><a href="javascript:void(0)" onmouseover="document.getElementById('J_tianxie').style.display='none';document.getElementById('J_xinxi').style.display='block';document.getElementById('more_1').href='./show_list.php?name=kj_section&amp;ed=2';">填写报修表单</a>
                                            {{--<a class="bg" href="javascript:void(0)" onmouseover="document.getElementById('J_xinxi').style.display='none';document.getElementById('J_tianxie').style.display='block';document.getElementById('more_1').href='./show_list.php?name=kj_section&amp;ed=3';">我的报修信息</a></b>--}}
                                        <font color="red" size="-1" face="微软雅黑"></font>
                                    </ul></div>
                                <!-- 报修表单 -->
                                <div class="down1" id="J_xinxi" style="display:block">
                                    <div class="left">
                                    <form  action="{{ url('/fix/text')}}" method="post">
                                   {{ csrf_field() }}
                                        <div class="form-group">
                                            <li><b>校区：</b></li>
                                            <li><select  name="xq" id="xq" class="select">
                                                    <option value="" selected>------请选择------</option>
                                                    <option value="中心校区">中心校区</option>
                                                    <option value="洪家楼校区">洪家楼校区</option>
                                                    <option value="千佛山校区">千佛山校区</option>
                                                    <option value="兴隆山校区">兴隆山校区</option>
                                                    <option value="趵突泉校区">趵突泉校区</option>
                                                    <option value="软件园校区">软件园校区</option>
                                                </select></li>

                                            <li><b>楼房：</b></li>
                                            <li><select name="lfh" id="lfh" class="select">
                                                    <option value="" selected>------请选择------</option>
                                                </select></li>

                                            <script>                                           //这里实现了下拉框的联动效果
                                                // 1. 为<select>元素绑定onchange事件
                                                var xq1 = document.getElementById("xq");
                                                xq1.onchange = function(){
                                                    // 将id为lfh的元素内容清空
                                                    var lfh = document.getElementById("lfh");
                                                    var opts = lfh.getElementsByTagName("option");
                                                    for(var z=opts.length-1;z>0;z--){
                                                        lfh.removeChild(opts[z]);
                                                    }

                                                    // 2. 获取用户当前选择的校区名称
                                                    var xq = xq1.value;
                                                    // 3. 创建对应的楼房列表 - 数组
                                                    var lfhs = [];
                                                    switch (xq){
                                                        case "中心校区":
                                                            lfhs = ["电教北楼","知新楼","董明珠楼","公教楼","理综楼","微生物楼","理综楼"];
                                                            break;
                                                        case "软件园校区":
                                                            lfhs = ["1区","2区","3区","4区","5区","一号楼","二号楼","三号楼","四号楼","五号楼"];
                                                            break;
                                                        case "洪家楼校区":
                                                            lfhs = ["公教楼","物理楼","新艺术楼","1号楼","2号楼","3号楼"];
                                                            break;
                                                        case "趵突泉校区":
                                                            lfhs = ["1号楼","2号楼","3号楼","4号楼","5号楼","6号楼","7号楼","8号楼","9号楼","图东","图西","护理新楼"];
                                                            break;
                                                        case "千佛山校区":
                                                            lfhs = ["1号楼","2号楼","3号楼","4号楼","5号楼","6号楼","7号楼","8号楼","9号楼"];
                                                            break;
                                                        case "兴隆山校区":
                                                            lfhs = ["群楼A座","群楼B座","群楼C座","群楼D座","5号楼","6号楼","7号楼","8号楼","9号楼","图东","图西","护理新楼"];
                                                            break;
                                                    }
                                                    // 遍历城市列表

                                                    for(var i=0;i<lfhs.length;i++){
                                                        // 4. 创建<option>元素
                                                        var option = document.createElement("option");
                                                        // 5. 将楼房的信息添加到<option>元素上
                                                        var textNode = document.createTextNode(lfhs[i]);
                                                        option.appendChild(textNode);
                                                        // 6. 将创建的所有<option>元素添加到id为lfh元素上
                                                        lfh.appendChild(option);
                                                    }


                                                }

                                            </script>






                                            <li><b>房间号：</b></li>
                                            <li><input name="room" id="room" class="select" value="规范数字填写" onfocus="if(this.value=='规范数字填写') this.value='';this.style.color='#333'; return true;" onblur="if(this.value=='') this.value='规范数字填写'; this.style.color='#999'; return true;" style="color: rgb(153, 153, 153); " /></li>

                                            <li><b>报修项目：</b></li>
                                            <li><select name="kind" id="kind" class="select">
                                                    <option value="" selected>------请选择------</option>
                                                    <option value="门窗">门窗</option>
                                                    <option value="晾衣杆">晾衣杆</option>
                                                    <option value="窗帘杆">窗帘杆</option>
                                                    <option value="家具(含床、桌椅)">家具(含床、桌椅)</option>
                                                    <option value="屋顶">屋顶</option>
                                                    <option value="墙壁">墙壁</option>
                                                    <option value="电灯">电灯</option>
                                                    <option value="电风扇">电风扇</option>
                                                    <option value="饮水机(本科)">饮水机(本科)</option>
                                                    <option value="电话线路">电话线路</option>
                                                    <option value="网络故障">网络故障</option>
                                                    <option value="--其他--">--其他--</option>
                                                </select></li>

                                            <li><b>学号：</b></li><li><input name="xh" id="xh" class="select" /></li>
                                            <li><b>姓名：</b></li><li><input name="name" id="name" class="select" /></li>
                                            <li><b>联系电话：</b></li><li><input name="phone" id="phone" class="select" value="手机号" onfocus="if(this.value=='手机号') this.value='';this.style.color='#333'; return true;" onblur="if(this.value=='') this.value='手机号'; this.style.color='#999'; return true;" style="color: rgb(153, 153, 153); "/></li>
                                            <div class="right" style="list-style-type:none;">
                                                <li ><b>报修项目描述：</b></li>
                                                <textarea name="remarks" id="remarks" class="text1"></textarea>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">上传图片</span>
                                                <!--只需要将输入的内容类型‘type’，定义为file即可；name为键   选中的文件为键值-->
                                                {{--<file name ="avatar" id="avatar" class="form-control"></file>--}}
                                                <input class="form-control" type="file" name="avatar">
                                            </div>
                                        </div>




                                       <div class="bottom">
                                            <button type="submit" class="input" style="font-size:15px; font-family:'微软雅黑'; cursor:pointer;">提交</button>
                                            <input class="input" id="resetz" type="reset" value="重置">
                                       </div>




                                   </form>






                            @elseif($SearchOption == 1)
                                <h2>....</h2>


                            @elseif($SearchOption == 2)
                                <h2>....</h2>


                            @elseif($SearchOption == 3)
                                <h2>,,,,</h2>


                            @elseif($SearchOption == 4)
                                <h2>,,,,</h2>


                            @elseif($SearchOption == 5)
                                <h2>,,,,</h2>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection