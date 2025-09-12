<section class=" w-scree flex flex-col p-10 items-center gap-5 select-none">
    <h1 class="text-4xl sm:text-5xl  ">Find Your Perfect Space</h1>
    <p class=" text-[1rem] sm:text-2xl text-[#333333] ">Browse our available rooms and find the perfect one for your needs.</p>
</section>
<section class=" w-screen justify-center items-center flex select-none">
    <div class="  w-[80%]   border border-[#dcdcdc] rounded-4xl p-10 ">
        <form action="">
        <div class=" flex sm:flex-row justify-around items-start flex-col ">
            
                <div class=" flex flex-row gap-5 mt-13">
                    <input type="checkbox" class="w-8 h-8 accent-green-400" />
                    <p class=" sm:text-2xl text-[1.2rem]">Show Available Only</p>
                </div>
                <div class=" flex flex-col gap-5">
                    <label for="RoomType" class=" sm:text-2xl text-[1.2rem]">Room Type</label>
                    <select name="RoomType" class="border border-[#dcdcdc] p-2 md:w-[200px] w-[150px]">
                        <option value="" disabled Selected>All Types</option>
                        <option value="Single">Single Room</option>
                        <option value="Double">Double Room</option>
                        <option value="Deluxe">Deluxe Room</option>
                        <option value="Suite">Suite Room</option>
                        <option value="Family">Family Room</option>
                    </select>
                </div>
                <div class=" flex flex-col gap-5">
                    <label for="Floor" class=" sm:text-2xl text-[1.2rem] ">Floor</label>
                    <select name="Floor" class=" border border-[#dcdcdc] rounded p-2 md:w-[200px]  w-[150px]">
                        <option value="" disabled selected>All Floors</option>
                        <option value="FirstFloor">First Floor</option>
                        <option value="SecondFloor">Second Floor</option>
                        <option value="ThirdFloor">Third Floor</option>
                        <option value="FourthFloor">Fourth Floor</option>
                    </select>
                    <button type="reset" class=" md:w-[200px] w-[150px] border border-[#dcdcdc] rounded p-2 mt-10 cursor-pointer">Reset Filters</button>
                </div>
            </form>
        </div>
    </div>
</section>